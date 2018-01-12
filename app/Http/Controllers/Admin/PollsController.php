<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Gate;
use Fresh\Nashemisto\Http\Requests\PollRequest;
use Fresh\Nashemisto\Repositories\PollsRepository;

class PollsController extends AdminController
{
    public function __construct(PollsRepository $rep)
    {
        $this->poll_rep = $rep;
        $this->areaH = 350;
        $this->areaW = 310;
        $this->template = 'admin.admin';
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
    }

    /**
     * @param PollRequest $request
     * @return mixed
     */
    public function index(PollRequest $request)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $polls = $this->poll_rep->get(['question', 'id', 'alias', 'created_at'],
                        false, true, [['question', 'like', '%' . $data['value'] . '%']]);
                    if ($polls) $polls->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $polls[] = $this->poll_rep->one($data['value']);
                    break;
                case 3:
                    $polls = $this->poll_rep->get(['question', 'id', 'alias', 'created_at'],
                        false, true, ['approved' => 0], ['created_at', 'desc']);
                    if ($polls) $polls->appends(['param' => $data['param']])->links();
                    break;
                default:
                    $polls = $this->poll_rep->get(['alias', 'question', 'created_at', 'id'],
                        false, true, ['approved' => 0], ['created_at', 'desc']);
                    if ($polls) $polls->appends(['param' => $data['param']])->links();
            }
        } else {
            $polls = $this->poll_rep->get(['alias', 'question', 'created_at', 'id'],
                false, 25, ['approved' => 1], ['created_at', 'desc']);
        }

        $this->content = view('admin.polls.show')->with(['polls' => $polls])->render();

        return $this->renderOutput();
    }

    public function create(PollRequest $request)
    {
        if (Gate::denies('UPDATE_POLLS')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->poll_rep->addPoll($request);

            if ($result) {
                return redirect()->route('admin_polls')->with(['status' => 'Створене нове опитування.']);
            } else {

                return redirect()->back()
                    ->withErrors(['message' => 'Помилка створення опитування, повторіть спробу пізніше.']);
            }
        }

        $this->tiny = true;
        $this->content = view('admin.polls.add')->render();

        return $this->renderOutput();
    }

    public function edit(PollRequest $request, $poll)
    {
        if (Gate::denies('UPDATE_POLLS')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->poll_rep->updatePoll($request, $poll);
            if ($result) {
                return redirect()->route('admin_polls')->with(['status' => 'Опитування оновлене.']);
            } else {

                return redirect()->back()
                    ->withErrors(['message' => 'Помилка оновлення опитування, повторіть спробу пізніше.']);
            }
        }
        $this->tiny = true;
        $this->content = view('admin.polls.edit')->with('poll', $poll);
        return $this->renderOutput();
    }

    /**
     * @param $poll
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function destroy($poll)
    {
        if (Gate::denies('UPDATE_POLLS')) {
            abort(404);
        }

        $result = $this->poll_rep->deletePoll($poll);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin_polls')->with($result);

    }*/
}
