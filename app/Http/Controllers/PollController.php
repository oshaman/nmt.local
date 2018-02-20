<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\PollStatistic;
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
//            dd($poll);
            $this->title = $poll->question;

            if ((1 != $poll->approved) || !empty(session('poll_id_' . $poll->id))) {
                $statistic = PollStatistic::select('n1', 'n2', 'n3', 'n4', 'n5')
                    ->where(['poll_id' => $poll->id])->first();

                $statistic = $statistic ? $statistic->toArray() : null;
            } else {
                $this->jss .= '<script src="' . asset('js/poll.js') . '"></script>';
                $statistic = null;
            }

            $poll = $this->poll_rep->cessationHandle($poll);

            $polls = $this->poll_rep->getPollsPreview($poll->id);

            $this->content = view('poll.poll')
                ->with(['polls' => $polls, 'poll' => $poll, 'statistic' => $statistic])
                ->render();
            return $this->renderOutput();
        } else {
            $this->title = 'Опитування';
            $this->seo = $this->seo_rep->getSeo('polls');

            $polls = $this->poll_rep->get(
                ['question', 'alias', 'description', 'image', 'alt', 'imgtitle', 'created_at', 'id'], false, 12,
                [['created_at', '<=', DB::raw('NOW()')], ['approved', true]], ['created_at', 'desc']
            );

            $polls = $this->poll_rep->countVoites($polls);

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
