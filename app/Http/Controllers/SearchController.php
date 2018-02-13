<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\SearchRepository;
use Illuminate\Http\Request;

class SearchController extends MainController
{
    protected $repository;

    /**
     * SearchController constructor.
     * @param SearchRepository $repository
     */
    public function __construct(SearchRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function showResult(Request $request)
    {
        $this->title = 'Пошук.';
        $result = $this->repository->getSearch($request);

        if (is_array($result) && !empty($result['error'])) {
            $this->content = view('static.search')->render();
        } else {
            $this->content = view('static.search')->with(['articles' => $result])->render();
        }
        return $this->renderOutput();
    }
}
