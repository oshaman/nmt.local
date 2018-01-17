<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Article;
use Fresh\Nashemisto\Http\Requests\ArticleRequest;
use Fresh\Nashemisto\Repositories\ArticlesRepository;
use Fresh\Nashemisto\Category;
use Fresh\Nashemisto\Repositories\CategoriesRepository;
use Fresh\Nashemisto\Tag;
use Fresh\Nashemisto\Repositories\TagsRepository;
use Gate;

class ArticlesController extends AdminController
{
    protected  $a_rep;

    /**
     * ArticlesController constructor.
     * @param ArticlesRepository $repository
     */
    public function __construct(ArticlesRepository $repository)
    {
        $this->template = 'admin.admin';
        $this->a_rep = $repository;
    }

    /**
     * @param ArticleRequest $request
     * @return mixed
     */
    public function index(ArticleRequest $request)
    {
//        dd('index');
        if (Gate::denies('view', new Article())) {
            abort(404);
        }

        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $articles = $this->a_rep->get(['title', 'id', 'alias', 'created_at', 'user_id'],
                        false, true, [['title', 'like', '%' . $data['value'] . '%']]);
                    if ($articles) $articles->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $articles[] = $this->a_rep->one($data['value']);
                    break;
                case 3:
                    $articles = $this->a_rep->get(['title', 'id', 'alias', 'created_at', 'user_id'],
                        false, true, ['approved' => 0], ['created_at', 'desc']);
                    if ($articles) $articles->appends(['param' => $data['param']])->links();
                    break;
                default:
                    $articles = $this->a_rep->get(['alias', 'title', 'created_at', 'id', 'user_id'],
                        false, true, ['approved' => 0], ['created_at', 'desc']);
                    if ($articles) $articles->appends(['param' => $data['param']])->links();
            }
        } else {
            $articles = $this->a_rep->get(['alias', 'title', 'created_at', 'id', 'user_id'],
                false, true, ['approved' => 1], ['created_at', 'desc']);
        }

        $this->content = view('admin.articles.show')->with(['articles' => $articles])->render();

        return $this->renderOutput();
    }

    /**
     * @param ArticleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function create(ArticleRequest $request)
    {
        if (Gate::denies('create', new Article())) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->a_rep->addArticle($request);

            if(is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->route('edit_article', $result['id'])->with($result);
//            return redirect()->route('admin_articles')->with($result);
        }

        $this->tiny = true;
        $this->title = 'Створення статті';
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
        //  get categories
        $cats = new CategoriesRepository(new Category);
        $lists = $cats->catSelect();
        //  get tags
        $tags = new TagsRepository(new Tag);
        $tag = $tags->tagSelect();

        $this->content = view('admin.articles.add')->with(['cats' => $lists, 'tags'=>$tag])->render();

        return $this->renderOutput();
    }

    /**
     * @param ArticleRequest $request
     * @param EstablishmentsRepository $e_rep
     * @param $article
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(ArticleRequest $request, $article)
    {
        if (Gate::denies('update', $article)) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->a_rep->updateArticle($request, $article);

            if(is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
//            return redirect()->route('admin_articles')->with($result);
            return redirect()->back()->with($result);
        }

        $this->title = 'Редагування статті';
        $this->tiny = true;
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
        //  get categories
        $cats = new CategoriesRepository(new Category);
        $lists = $cats->catSelect();
        //  get tags
        $tags = new TagsRepository(new Tag);
        $tag = $tags->tagSelect();

        $img = $article->image;

        $this->content = view('admin.articles.edit')
            ->with(['article'=>$article, 'cats' => $lists, 'tags'=>$tag, 'img'=>$img])->render();

        return $this->renderOutput();

    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del($article)
    {
        if (Gate::denies('delete', $article)) {
            abort(404);
        }

        $result = $this->a_rep->deleteArticle($article);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin_articles')->with($result);
    }
}
