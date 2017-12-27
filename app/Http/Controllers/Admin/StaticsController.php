<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Repositories\StaticPageRepositiory;
use Illuminate\Http\Request;
use Gate;

class StaticsController extends AdminController
{
    protected $repository;

    public function __construct(StaticPageRepositiory $repository)
    {
        $this->repository = $repository;
        $this->template = 'admin.admin';
    }

    public function index()
    {
        if (Gate::denies('UPDATE_STATIC')) {
            abort(404);
        }

        $pages = $this->repository->get(['id', 'title', 'text', 'own']);
        $this->content = view('admin.statics.show')->with(['pages' => $pages])->render();
        return $this->renderOutput();
    }

    public function edit(Request $request, $static_page = false)
    {
        if (Gate::denies('UPDATE_STATIC')) {
            abort(404);
        }
        if ($request->isMethod('post')) {
            $result = $this->repository->updateStaticPage($request, $static_page);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result['error']);
            }
            return redirect()->route('admin_static')->with($result);
        }
        $this->tiny = true;
        $this->areaW = 770;
        $this->content = view('admin.statics.edit')->with(['page' => $static_page])->render();
        return $this->renderOutput();
    }
}
