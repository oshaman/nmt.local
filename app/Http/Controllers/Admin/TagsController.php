<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Requests\TagsRequest;
use Fresh\Nashemisto\Repositories\TagsRepository;
use Validator;
use Gate;

class TagsController extends AdminController
{
    protected $tag_rep;

    /**
     * TagsController constructor.
     * @param TagsRepository $rep
     */
    public function __construct(TagsRepository $rep)
    {
        $this->title = 'Теги.';
        $this->tag_rep = $rep;
        $this->template = 'admin.admin';
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
    }

    /**
     * View or Create Tags
     * @param Request $request
     * @return View
     */
    public function index(TagsRequest $request)
    {
        if (Gate::denies('UPDATE_PRIORITY')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->tag_rep->addTag($request);

            if ($result) {
                return back()->with(['status'=>'Створений новий тэг.']);
            } else {

                return redirect()->back()->withErrors(['message'=>'Помилка створення тега, повторіть спробу пізніше.']);
            }
        }

        $tags = $this->tag_rep->get(['name', 'id', 'alias'], false, 25);
        $this->content = view('admin.tags.content')->with('tags', $tags)->render();

        return $this->renderOutput();
    }

    /**
     * Tag update
     * @param Request $request
     * @param $tag tag_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
   public function edit(TagsRequest $request, $tag)
    {
        if (Gate::denies('UPDATE_PRIORITY')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->tag_rep->updateTag($request, $tag);
            if ($result) {
                return redirect()->route('admin_tags')->with(['status'=>'Тег оновлений.']);
            } else {

                return redirect()->back()->withErrors(['message'=>'Помилка оновлення тега, повторіть спробу пізніше.']);
            }
        }

        $this->content = view('admin.tags.edit')->with('tag', $tag);
        return $this->renderOutput();
    }

    /**
     * @param $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($tag)
    {
        if (Gate::denies('UPDATE_PRIORITY')) {
            abort(404);
        }

        $result = $this->tag_rep->deleteTag($tag);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin_tags')->with($result);

    }
}
