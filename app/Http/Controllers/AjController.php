<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\ArticlesRepository;
use Illuminate\Http\Request;
use Cache;

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
            default:
                return false;
        }
    }

    public function getByCat($page, $id = null)
    {
        $currentPage = $page ? (int)$page : 1;
        $id = $id ? (int)$id : null;
        if (null == $id) {

            $articles = $this->a_rep->getMore('*', 9, ['approved' => 1],
                ['created_at', 'desc'], ['image', 'tags'], 9 * $currentPage);

            return view('articles.get_more')->with(['articles' => $articles])
                ->render();
        } else {

            $articles = $this->a_rep->getMore('*', 9, ['approved' => 1, 'category_id' => $id],
                ['created_at', 'desc'], ['image', 'tags'], 9 * $currentPage);

            return view('articles.get_more')->with(['articles' => $articles])
                ->render();
        }
    }
}
