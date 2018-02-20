<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Repositories\InformRepository;
use Illuminate\Http\Request;
use Gate;

class InformerController extends AdminController
{
    protected $repo;

    /**
     * InformerController constructor.
     * @param InformerRepository $repository
     */
    public function __construct(InformRepository $repository)
    {
        $this->template = 'admin.admin';
        $this->tiny = true;
        $this->title = 'Повідомити новину';
        $this->repo = $repository;
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(Request $request)
    {
        if (Gate::denies('UPDATE_STATIC')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'text' => 'nullable|string|max:2000',
            ]);
            $result = $this->repo->updateInformer($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->back()->with($result);
        }

        $text = $this->repo->findById(1);

        $this->content = view('admin.informer.text')->with(compact('text'))->render();
        return $this->renderOutput();
    }
}
