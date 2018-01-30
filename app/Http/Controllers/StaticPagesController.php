<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\ArticlesRepository;
use Fresh\Nashemisto\Repositories\SeoRepository;
use Fresh\Nashemisto\Repositories\StaticPageRepositiory;
use Illuminate\Http\Request;
use Cache;

class StaticPagesController extends MainController
{
    protected $repository;
    protected $a_rep;
    protected $seo_rep;

    /**
     * StaticPagesController constructor.
     * @param ArticlesRepository $a_rep
     * @param StaticPageRepositiory $repository
     * @param SeoRepository $seo_rep
     */
    public function __construct(
        ArticlesRepository $a_rep,
        StaticPageRepositiory $repository,
        SeoRepository $seo_rep
    )
    {
        $this->repository = $repository;
        $this->seo_rep = $seo_rep;
        $this->a_rep = $a_rep;
    }

    /**
     * @param Request $request
     * @return view
     */
    public function contacts(Request $request)
    {
        $name = 'contacts';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param Request $request
     * @return view
     */
    public function about(Request $request)
    {
        $name = 'pro-nas';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param Request $request
     * @return view
     */
    public function reklama(Request $request)
    {
        $name = 'reklama';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param Request $request
     * @return view
     */
    public function redakciya(Request $request)
    {
        $name = 'redakciya';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param Request $request
     * @return view
     */
    public function ugoda(Request $request)
    {
        $name = 'ugoda';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param Request $request
     * @return view
     */
    public function kontakty(Request $request)
    {
        $name = 'kontakty';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param Request $request
     * @return view
     */
    public function pravyla(Request $request)
    {
        $name = 'pravyla';
        return $this->cacheHandler($request, $name);
    }

    /**
     * @param $name
     * @return view
     */
    public function cacheHandler($request, $name)
    {
        $page = Cache::remember($name, 24 * 60, function () use ($name) {
            $model = $this->repository->get(['title', 'text', 'updated_at'], false, false, ['own' => $name]);
            $model = $model->first();
            $model->seo = $this->seo_rep->getSeo($name);
            return $model;
        });
//            Last Modify
        $LastModified_unix = strtotime($page->updated_at); // время последнего изменения страницы
        $this->lastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if ($request->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($request->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            return response('304 Not Modified', 304);
        }
//            Last Modify
        $this->seo = $page->seo;

        $this->title = trans('admin.' . $name);
        $articles = Cache::remember('articles_last', 24 * 60, function () {
            $where = [['approved', 1]];
            $articles = $this->a_rep->get('*', 3, false, $where, ['created_at', 'desc'], ['category', 'image'], true);
            return $articles;
        });

        $this->content = view('static.' . $name)->with(['article' => $page, 'articles' => $articles])->render();

        return $this->renderOutput();
    }
}
