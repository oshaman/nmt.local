<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\ArticlesRepository;
use Fresh\Nashemisto\Repositories\CategoriesRepository;
use Fresh\Nashemisto\Repositories\TagsRepository;
use Illuminate\Http\Request;
use Cache;
use DB;

class ArticleController extends MainController
{
    protected $a_rep;
    protected $c_rep;
    protected $t_rep;

    /**
     * ArticleController constructor.
     * @param ArticlesRepository $arep
     * @param CategoriesRepository $crep
     * @param TagsRepository $trep
     */
    public function __construct(ArticlesRepository $arep, CategoriesRepository $crep, TagsRepository $trep)
    {
        $this->a_rep = $arep;
        $this->c_rep = $crep;
        $this->t_rep = $trep;
    }

    /**
     * @param Request $request
     * @param $article
     * @return mixed
     */
    public function show(Request $request, $article)
    {
        $article = Cache::remember('article_' . $article, 24 * 60, function () use ($article) {
            $article = $this->a_rep->one($article);
            if (null == $article) return null;
            $article->load('category');
            $article->load('tags');
            $article->load('image');
            $article->load('seo');

            if (empty($article->seo)) {
                $article->seo = new \stdClass();
            }
            if (empty($article->seo->og_image)) {
                $article->seo->og_image = asset('asset/images/articles/main') . '/' . $article->image->path;
            }

            $article = $this->a_rep->convertDate($article);

            return $article;
        });

        if (null == $article) {
            abort(404);
        }

        //            Last Modify
        $LastModified_unix = strtotime($article->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify

        $article->timestamps = false;
        $article->increment('view');
        $article->timestamps = true;

        $this->title = $article->title;
        $this->seo = $article->seo;

        $articles = Cache::remember('articles_' . $article->category_id . $article->id, 24 * 60, function () use ($article) {
            $where = [['category_id', $article->category_id], ['approved', 1], ['id', '<>', $article->id]];
            $articles = $this->a_rep->get('*', 3, false, $where, false, ['category', 'image'], true);
            return $articles;
        });
//        dd($articles);
        $cats = $this->c_rep->get(['name', 'alias'], 5, false, ['approved' => 1]);

        $this->content = view('articles.article')
            ->with(['article' => $article, 'articles' => $articles, 'categories' => $cats])
            ->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param bool $cat_alias
     * @return $this|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cats(Request $request, $cat_alias = false)
    {
//  Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//  Last Modified
        if (false == $cat_alias) {
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $this->content = Cache::remember('article-cat-all' . $currentPage, 60, function () {
                $articles = $this->a_rep->get('*', false, 12,
                    ['approved' => 1], ['created_at', 'desc'], ['image', 'tags'], true);
                $cats = $this->c_rep->get(['name', 'alias'], 5, false, ['approved' => 1]);
                return view('articles.category')->with(['articles' => $articles, 'categories' => $cats])
                    ->render();
            });

            $this->title = 'Всі новини';
        } else {
            $cat = $this->c_rep->one($cat_alias);
            if (null == $cat) {
                abort(404);
            }
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            $this->content = Cache::remember('article-cat-' . $cat->id . $currentPage, 60, function () use ($cat) {
                $articles = $this->a_rep->get('*', false, 12,
                    ['category_id' => $cat->id, 'approved' => 1], ['created_at', 'desc'], ['image', 'tags'], true);
                $cats = $this->c_rep->get(['name', 'alias'], 5, false, ['approved' => 1]);
                return view('articles.category')->with(['articles' => $articles, 'cat' => $cat, 'categories' => $cats])
                    ->render();
            });

            $this->title = $cat->name;
        }
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $tag_alias
     * @return $this|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function tags(Request $request, $tag_alias)
    {
//  Last Modified
        $lastM = DB::select('SELECT MAX(`updated_at`) as last FROM `articles` WHERE `approved`=1');

        $LastModified_unix = strtotime($lastM[0]->last); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//  Last Modified

        $tag = $this->t_rep->one($tag_alias);
        if (null == $tag) {
            abort(404);
        }
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('article-tag-' . $tag->id . $currentPage, 60, function () use ($tag) {
            $articles = $this->a_rep->getByTag($tag->id);
            $cats = $this->c_rep->get(['name', 'alias'], 5, false, ['approved' => 1]);
            return view('articles.tag')->with(['articles' => $articles, 'tag' => $tag, 'categories' => $cats])
                ->render();
        });

        $this->title = $tag->name;

        return $this->renderOutput();
    }
}
