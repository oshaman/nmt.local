<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\PollsRepository;
use Fresh\Nashemisto\Repositories\SeoRepository;
use Illuminate\Http\Request;
use Cache;
use DB;

class PollController extends MainController
{
    protected $poll_rep;
    protected $seo_rep;

    /**
     * PollController constructor.
     * @param PollsRepository $poll
     */
    public function __construct(PollsRepository $poll, SeoRepository $seo)
    {
        $this->poll_rep = $poll;
        $this->seo_rep = $seo;
    }

    /**
     * @param null $poll
     */
    public function index($poll = null)
    {
        if (!empty($poll)) {
            $this->title = 'Опитування';
            $this->seo = $this->seo_rep->getSeo('polls');

            $polls = '';
            $this->content = view('poll.poll')->with(['polls' => $polls])->render();
            return $this->renderOutput();
        } else {
            $this->title = 'Опитування';
            $this->seo = $this->seo_rep->getSeo('polls');

            $polls = $this->poll_rep->get(
                ['question', 'alias'], false, 2,
                [['approved', true], ['created_at', '<=', DB::raw('NOW()')]], ['created_at', 'desc']
            );
            $this->content = view('poll.show')->with(['polls' => $polls])->render();
            return $this->renderOutput();
        }
    }

    /**
     * @param Request $request
     * @return $this|bool|\Illuminate\Http\RedirectResponse
     */
    public function addToPolls(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->filled('stats')) return false;

            $result = $this->poll_rep->addToPolls($request);

            if (false !== $result['stats']) {
                $request->session()->put('poll_id_' . $result['poll']['id'], $result['answer']);
            }

            return view('poll.result')
                ->with(['poll' => $result['poll'], 'stats' => $result['stats']])
                ->render();
        }
        return false;
    }
}
