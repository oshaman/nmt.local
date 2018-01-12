<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Category;
use Fresh\Nashemisto\Repositories\CategoriesRepository;
use Fresh\Nashemisto\Repositories\PriorityRepository;
use Gate;
use Fresh\Nashemisto\Http\Requests\PriorityRequest;

class PriorityController extends AdminController
{
    protected $p_rep;

    /**
     * PriorityController constructor.
     * @param PriorityRepository $p_rep
     */
    public function __construct(PriorityRepository $p_rep)
    {
        $this->p_rep = $p_rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param PriorityRequest $request
     * @return mixed
     */
    public function index(PriorityRequest $request)
    {
        if (Gate::denies('UPDATE_PRIORITY')) {
            abort(404);
        }

        $priority = null;
        if ($request->isMethod('post')) {
            $priority = $this->p_rep->getPriority($request);
        }

        $cats = new CategoriesRepository(new Category);
        $lists = $cats->catSelect();
        $lists[10000] = 'Загальний ТОП';

//        dd($priority);
        $this->content = view('admin.priority.show')->with(['cats' => $lists, 'priority' => $priority])->render();

        return $this->renderOutput();
    }

    /**
     * @param PriorityRequest $request
     * @param $priority
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit(PriorityRequest $request, $priority)
    {
        if (Gate::denies('UPDATE_PRIORITY')) {
            abort(404);
        }

        $result = $this->p_rep->updatePriority($request, $priority);

        if ($result) {
            return redirect()->route('admin_priority')->with(['status' => 'Контент оновлений.']);
        } else {
            return redirect()->back()->withErrors(['message' => 'Помилка оновлення, повторіть спробу пізніше.']);
        }
    }
}
