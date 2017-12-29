<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Category;
use Fresh\Nashemisto\Repositories\ArticlesRepository;
use Fresh\Nashemisto\Tag;
use Illuminate\Http\Request;
use Cache;
use Illuminate\Pagination\Paginator;

class AjController extends Controller
{
    protected $a_rep;

    public function __construct(ArticlesRepository $arep)
    {
        $this->a_rep = $arep;
    }

    public function getMore(Request $request)
    {
        $data = $request->all();

        switch ($data['source']) {
            case 1:
                return $this->getByCat($data['page'], $data['source_id'] ?? null);
                break;
            case 2:
                return $this->getByTag($data['page'], $data['source_id'] ?? null);
                break;
            default:
                return false;
        }
    }

    /**
     * @param $page
     * @param null $id
     * @return string
     */
    public function getByCat($page, $id = null)
    {
        $currentPage = $page ? (int)$page : 1;
        $id = $id ? (int)$id : null;
        if (null == $id) {
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage + 1;
            });
            Paginator::currentPathResolver(function () {
                return route('category');
            });
            $articles = $this->a_rep->get('*', false, 12, ['approved' => 1],
                ['created_at', 'desc'], ['image'], true);

            return view('articles.get_more')->with(['articles' => $articles])
                ->render();
        } else {
            $cat = Category::where(['id' => $id])->first();

            if (empty($cat)) {
                return '';
            } else {

                Paginator::currentPageResolver(function () use ($currentPage) {
                    return $currentPage + 1;
                });
                Paginator::currentPathResolver(function () use ($cat) {
                    return route('category', $cat->alias);
                });
                $articles = $this->a_rep->get('*', false, 12,
                    ['approved' => 1, 'category_id' => $cat->id], ['created_at', 'desc'], ['image'], true);

                return view('articles.get_more')->with(['articles' => $articles])
                    ->render();
            }
        }
    }

    /**
     * @param $page
     * @param null $id
     * @return bool|string
     */
    public function getByTag($page, $id = null)
    {
        $currentPage = $page ? (int)$page : 1;
        $id = $id ? (int)$id : null;

        if (null == $id) return false;

        $tag = Tag::find($id);
        if (0 === $tag) return false;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage + 1;
        });
        Paginator::currentPathResolver(function () use ($tag) {
            return route('tag', $tag->alias);
        });
        $articles = $this->a_rep->getByTag($id);

        return view('articles.get_more')->with(['articles' => $articles])
            ->render();

    }
}
