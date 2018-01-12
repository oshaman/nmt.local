<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Requests\CatRequest;
use Fresh\Nashemisto\Repositories\CategoriesRepository;
use Gate;
use Validator;

class CatsController extends AdminController
{
    protected $cat_rep;

    public function __construct(CategoriesRepository $rep)
    {
        $this->cat_rep = $rep;
        $this->template = 'admin.admin';
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
    }

    /**
     * View or Create Catigories
     * @param Request $request
     * @return View
     */
    public function index(CatRequest $request)
    {
        if (Gate::denies('UPDATE_CATS')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->cat_rep->addCat($request);

            if ($result) {
                return back()->with(['status'=>'Нову категорію додано.']);
            } else {

                return redirect()->back()
                    ->withErrors(['message'=>'Помилка оновлення категорії, повторіть спробу пізніше.']);
            }

        }

        $cats = $this->cat_rep->get(['name', 'id', 'alias', 'approved'], false, true);
        $this->content = view('admin.articles.cats.content')->with('categories', $cats);

        return $this->renderOutput();
    }

    /**
     * Category update
     * @param Request $request
     * @param $cat cat_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit(CatRequest $request, $cat)
    {
        if (Gate::denies('UPDATE_CATS')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->cat_rep->updateCat($request, $cat);

            if(is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error'])->withInput();
            }

            if ($result) {
                return redirect()->route('cats')->with(['status'=>'Категорію оновлено.']);
            } else {
                return redirect()->back()->withErrors(['message'=>'Помилка оновлення категорії, повторіть спробу пізніше.']);
            }
        }

        $this->content = view('admin.articles.cats.edit')->with('category', $cat);
        return $this->renderOutput();
    }
}
