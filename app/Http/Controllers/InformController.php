<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\InformRepository;
use Illuminate\Http\Request;

class InformController extends MainController
{
    protected $repository;

    public function __construct(InformRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->repository->send($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withInput()->withErrors($result['error']);
            }
            return redirect()->back()->with($result);
        }

        $this->jss = '<script src="' . asset('js/add-news.js') . '"></script>';

        $this->content = view('static.inform')->render();
        return $this->renderOutput();
    }
}
