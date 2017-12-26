<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\PollsRepository;
use Illuminate\Http\Request;

class PollController extends MainController
{
    protected $poll_rep;

    /**
     * PollController constructor.
     * @param PollsRepository $poll
     */
    public function __construct(PollsRepository $poll)
    {
        $this->poll_rep = $poll;
    }

    /**
     * @param Request $request
     * @return $this|bool|\Illuminate\Http\RedirectResponse
     */
    public function addToPolls(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->filled('stats')) return redirect()->back();

            $result = $this->poll_rep->addToPolls($request);

            if (false !== $result['stats']) {
                $request->session()->put('poll_id_' . $result['poll']['id'], true);
            }

            return view('poll.result')
                ->with(['poll' => $result['poll'], 'stats' => $result['stats']])
                ->render();
            /*$this->content = view('poll.result')
                ->with(['poll'=>$result['poll'], 'stats'=>$result['stats']])
                ->render();

            return $this->renderOutput();*/
        }
        return false;
    }
}
