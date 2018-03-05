<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Article;
use Gate;
use File;
use Image;
use Config;
use Validator;
use Cache;
use DB;

class ArticlesRepository extends Repository
{
    /**
     * ArticlesRepository constructor.
     * @param Article $rep
     */
    public function __construct(Article $rep)
    {
        $this->model = $rep;
    }

    public function getTops($with, $where, $where_in = false, $where_not = false, $order = false, $take = false)
    {

        $builder = $this->model->with($with);

        if ($where) {
            $builder->where($where);
        }

        if ($where_in) {
            $builder->whereIn('id', $where_in);
        }

        if ($where_not) {
//            $where_not = array_diff($where_not, ['']);
            $builder->whereNotIn('id', $where_not);
        }

        if ($order) {
            $builder->orderBy($order[0], $order[1]);
        }

        if ($take) {
            $builder->take($take);
        }

        return $this->check($builder->get(), true);
    }

    /**
     * @param $request
     * @return Result array
     */
    public function addArticle($request)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $data = $request->except('_token');

        $article['title'] = $data['title'];
        $article['preview'] = str_limit(strip_tags($data['preview']), 600);

        $article['alias'] = $data['alias'];
        $article['category_id'] = $data['category_id'];
        $article['user_id'] = auth()->user()->id;

        if (!empty($data['confirmed'])) {
            if (Gate::allows('CONFIRMATION_DATA')) {
                $article['approved'] = 1;
            }
        }


        if (!empty($data['imgalt'])) {
            $img_prop['imgalt'] = $data['imgalt'];
        } else {
            $img_prop['imgalt'] = null;
        }

        if (!empty($data['imgtitle'])) {
            $img_prop['imgtitle'] = $data['imgtitle'];
        } else {
            $img_prop['imgtitle'] = null;
        }

        if (!empty($data['outputtime'])) {
            $article['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }

        //        Content
        $article['content'] = preg_replace('/{{.*}}/', '', $data['content'] ?? null);

        $article['hasvideo'] = $this->hasVideo($article['content']);
        $article['hasimage'] = $this->hasImage($article['content']);


//        END Content
        $new = $this->model->firstOrCreate($article);

        $error = [];
        if (!empty($new)) {
            // Main Image handle
            if ($request->hasFile('img')) {
                $path = $this->mainImg($request->file('img'), $article['alias']);

                if (false === $path) {
                    $error[] = ['img' => 'Помилка завантаження зображення'];
                } else {
                    $img = $new->image()->create(
                        ['path' => $path, 'alt' => $img_prop['imgalt'], 'title' => $img_prop['imgtitle']]
                    );
                }

                if (null == $img) {
                    $error[] = ['img' => 'Помилка збереження зображення'];
                }
            }
            // Tags
            if (!empty($data['tags'])) {

                try {
                    $new->tags()->attach($data['tags']);
                } catch (Exception $e) {
                    \Log::info('Помилка збереження тегів: ', $e->getMessage());
                    $error[] = ['tag' => 'Помилка збереження тегів'];
                }
            }

            $this->clearArticlesCache(false, $new->category_id);
            return ['status' => 'Статтю додано', 'id' => $new->id];
        }
        return ['error' => $error];
    }

    /**
     * @param $request
     * @param Article $article
     * @return array - Result
     */
    public function updateArticle($request, $article)
    {
        $data = $request->except('_token', 'img');
        $article->load('image');

        if ($data['title'] !== $article->title) {
            $new['title'] = $data['title'];
        }

        if ($data['preview'] !== $article->preview) {
            $new['preview'] = str_limit(strip_tags($data['preview']), 600);
        }

        if ($data['alias'] !== $article->alias) {
            $new['alias'] = $data['alias'];
        } else {
            $new['alias'] = $article['alias'];
        }

        if ($data['category_id'] !== $article->category_id) {
            $new['category_id'] = $data['category_id'];
        }

        if ($data['imgalt'] !== $article->image->alt) {
            $new['imgalt'] = $data['imgalt'];
        } else {
            $new['imgalt'] = $article->image->alt;
        }

        if ($data['imgtitle'] !== $article->image->title) {
            $new['imgtitle'] = $data['imgtitle'];
        } else {
            $new['imgtitle'] = $article->image->title;
        }

        if (empty($data['tags'])) {
            $data['tags'] = null;
        }

        if (!empty($data['outputtime'])) {
            $new['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }

        if (!empty($data['view']) && Gate::allows('UPDATE_VIEW')) {
            $new['view'] = (int)$data['view'];
        }

        if (!empty($data['confirmed'])) {
            $new['approved'] = 1;
        } else {
            $new['approved'] = 0;
        }

        $new['content'] = preg_replace('/{{.*}}/', '', $data['content'] ?? null);
        $article['hasvideo'] = $this->hasVideo($new['content']);
        $article['hasimage'] = $this->hasImage($new['content']);

        $updated = $article->fill($new)->save();

        $error = '';
        if (!empty($updated)) {

            $old_img = $article->image->path;
            // Main Image handle
            if ($request->hasFile('img')) {
                $path = $this->mainImg($request->file('img'), $new['alias']);

                if (false === $path) {
                    $error[] = ['img' => 'Помилка завантаження зображення'];
                } else {
                    $img = $article->image()->update(['path' => $path, 'alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                }

                if (empty($img)) {
                    $error[] = ['img' => 'Помилка збереження зображення'];
                }
                //DELETE OLD IMAGE
                $this->deleteOldImage('articles', $old_img);
            } else {
                try {
                    $article->image()->update(['alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                } catch (Exception $e) {
                    \Log::info('Помилка збереження зображення(update): ', $e->getMessage());
                    $error[] = ['img' => 'Помилка збереження зображення'];
                }
            }

            try {
                $article->tags()->sync($data['tags']);
            } catch (Exception $e) {
                \Log::info('Помилка збереження тегів(update): ', $e->getMessage());
                $error[] = ['tag' => 'Помилка збереження тегів'];
            }

            $this->clearArticlesCache($article->alias, $article->category_id);

            return ['status' => 'Статтю оновлено', $error];
        }
        return ['error' => $error];
    }

    /**
     *
     * @param $article
     * @return Result array
     */
    public function deleteArticle($article)
    {
        // $article->comments()->delete();
        $alias = $article->alias;
        if (!empty($article->image->path)) {
            $old_img = $article->image->path;
        }

        if ($article->delete()) {

            if (!empty($old_img)) {
                $this->deleteOldImage('articles', $old_img);
            }
            $this->clearArticlesCache($alias);

            return ['status' => 'Cтаттю видалено'];
        }
    }

    /**
     * delete old main image
     * @param $path
     * @return true
     */
    public function deleteOldImage($source, $path)
    {
        if (File::exists(public_path('/asset/images/' . $source . '/main/') . $path)) {
            File::delete(public_path('/asset/images/' . $source . '/main/') . $path);
        }
        if (File::exists(public_path('/asset/images/' . $source . '/middle/') . $path)) {
            File::delete(public_path('/asset/images/' . $source . '/middle/') . $path);
        }
        if (File::exists(public_path('/asset/images/' . $source . '/small/') . $path)) {
            File::delete(public_path('/asset/images/' . $source . '/small/') . $path);
        }
        return true;
    }


    /**
     * @param File $image
     * @param $alias
     * @param string $position
     * @return bool|string
     */
    public function mainImg($image, $alias, $position = 'center')
    {
        if ($image->isValid()) {

            $img = Image::make($image);
            $mime = $img->mime();

            switch ($mime) {
                case 'image/png':
                    $extention = '.png';
                    break;
                default:
                    $extention = '.jpeg';
            }

            $path = substr($alias, 0, 64) . '-' . time() . $extention;

            $img->resize(Config::get('settings.articles_img')['main']['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path() . '/asset/images/articles/main/' . $path, 70);
            $img->fit(Config::get('settings.articles_img')['middle']['width'], Config::get('settings.articles_img')['middle']['height'])
                ->save(public_path() . '/asset/images/articles/middle/' . $path, 80);
            $img->fit(Config::get('settings.articles_img')['small']['width'], Config::get('settings.articles_img')['small']['height'])
                ->save(public_path() . '/asset/images/articles/small/' . $path, 80);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * @param $tag
     * @return articles collection
     */
    public function getByTag($tag)
    {
        $articles = $this->model->whereHas('tags', function ($q) use ($tag) {
            $q->where('tag_id', $tag)->select('title', 'alias');
        });

        $articles->with(['image', 'category']);

        return $this->check($articles->paginate(Config::get('settings.paginate_tags')), true);

    }

    /**
     * @param $articles
     * @return bool
     */
    public function contentHandle($articles)
    {
        if (null == $articles || $articles->isEmpty()) {
            return FALSE;
        }

        $articles->transform(function ($item) {

            if ($item->content) {
                $item->content = str_limit(strip_tags($item->content), 800);
            }

            return $item;

        });

        return $articles;
    }

    /**
     * Clear
     */
    protected function clearArticlesCache($alias = false, $cat = false)
    {
        Cache::forget('article_' . $alias);
        Cache::forget('404');
        Cache::forget('articles_last');
        !empty($cat) ? Cache::forget('articles_' . $cat) : null;
        !empty($cat) ? Cache::forget('article-cat-' . $cat . '1') : null;
        !empty($cat) ? Cache::forget('article-cat-all1') : null;
        /*
        !empty($id) ? Cache::store('file')->forget('patients_article-' . $id) : null;
        */

    }

    public function hasVideo($content)
    {
        $re = '/<iframe /';
        preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
        if (count($matches) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hasImage($content)
    {
        $re = '/<img [^>]+>/';
        preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
        if (count($matches) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
