<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Cache;
use DB;
use Fresh\Nashemisto\Repositories\CardRepository;
use Fresh\Nashemisto\Repositories\TransmissionRepository;
use Validator;
use Fresh\Nashemisto\Repositories\PriorityRepository;
use Fresh\Nashemisto\Repositories\SeoRepository;
use Illuminate\Http\Request;
use Fresh\Nashemisto\PollStatistic;
use Fresh\Nashemisto\Repositories\ArticlesRepository;
use Fresh\Nashemisto\Repositories\CategoriesRepository;
use Fresh\Nashemisto\Repositories\ChannelsRepository;
use Fresh\Nashemisto\Repositories\PollsRepository;

class IndexController extends MainController
{
    protected $poll_rep;
    protected $a_rep;
    protected $c_rep;
    protected $ch_rep;
    protected $seo_rep;
    protected $p_rep;
    protected $transmission_rep;
    protected $card_rep;

    /**
     * IndexController constructor.
     * @param PollsRepository $poll
     * @param ArticlesRepository $arep
     * @param CategoriesRepository $cats
     * @param ChannelsRepository $channelsRepository
     */
    public function __construct(
        PollsRepository $poll,
        ArticlesRepository $arep,
        CategoriesRepository $cats,
        ChannelsRepository $channelsRepository,
        SeoRepository $seorep,
        PriorityRepository $priority,
        TransmissionRepository $transmission_rep,
        CardRepository $card
    )
    {
        $this->poll_rep = $poll;
        $this->a_rep = $arep;
        $this->c_rep = $cats;
        $this->seo_rep = $seorep;
        $this->ch_rep = $channelsRepository;
        $this->p_rep = $priority;
        $this->transmission_rep = $transmission_rep;
        $this->card_rep = $card;
    }

    /***
     * @return $this
     */
    public function show()
    {
//        Cache::flush();
//        session()->flush();
        $this->title = 'Головна';
//POLL
        $poll = $this->poll_rep->getNewest();
//        dd($poll);
        if (empty(session('poll_id_' . $poll->id))) {
            $this->jss .= '<script src="' . asset('js/poll.js') . '"></script>';
            $statistic = null;
        } else {
            $statistic = PollStatistic::select('n1', 'n2', 'n3', 'n4', 'n5')->where(['poll_id' => $poll->id])->first();
            $statistic = $statistic->toArray();
        }
        $this->poll = view('static.poll')->with(['poll' => $poll, 'statistic' => $statistic])->render();
//POLL
//VIDEO
        $channels = Cache::remember('main-channels', 60, function () {
            return $this->ch_rep->get('*', false, false, ['approved' => 1], false, ['videos']);
        });
//VIDEO
//ONLINE
        $transmission = $this->transmission_rep->getOnline();
        $cards = $this->card_rep->get(['title', 'created_at'], false, false,
            [['approved', true], ['created_at', '>=', DB::raw('NOW()')]]);
//ONLINE
//SEO
        $this->seo = Cache::remember('seo_main', 24 * 60, function () {
            return $this->seo_rep->getSeo('/');
        });
//SEO

        $top_id = $this->p_rep->getTop(10000);

        if (count($top_id) > 0) {
            $tops = $this->a_rep->getTops(['image', 'category'], [['approved', true], ['created_at', '<=', DB::raw('NOW()')]],
                $top_id, false, ['created_at', 'desc']);
        } else {
            $tops = [];
        }

        if ($tops) {
            $take = 12 - count($tops);
        } else {
            $take = 12;
        }
        $where = [['approved', true], ['created_at', '<=', DB::raw('NOW()')]];
        $articles = $this->a_rep
            ->getTops(['image', 'category'], $where, false, $top_id, ['created_at', 'desc'], $take);

        if (!empty($tops)) {
            $articles = $tops->concat($articles);
        }

        $cats = $this->c_rep->get(['name', 'alias', 'id'], 5, false, ['approved' => 1]);

        $this->content = view('static.main')
            ->with([
                'articles' => $articles,
                'categories' => $cats,
                'channels' => $channels,
                'transmission' => $transmission,
                'cards' => $cards
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getArticles(Request $request)
    {
        if ($request->isMethod('post')) {

            $cat = $this->c_rep->findById((int)$request->get('cat'));

            if (null == $cat) {
                $where = [['approved', true], ['created_at', '<=', DB::raw('NOW()')]];
            } else {
                $where = [['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['category_id', $cat->id]];
            }


            $top_id = $this->p_rep->getTop($cat->id ?? 10000);
            if ($top_id) {
                $tops = $this->a_rep->getTops(['image', 'category'], $where,
                    $top_id, false, ['created_at', 'desc']);
            } else {
                $tops = null;
            }

            if ($tops) {
                $take = 12 - count($tops);
            } else {
                $take = 12;
            }

            $articles = $this->a_rep
                ->getTops(['image', 'category'], $where, false, $top_id, ['created_at', 'desc'], $take);

            if (!empty($tops)) {
                $articles = $tops->concat($articles);
            }

            return view('static.get_articles')
                ->with(['articles' => $articles, 'cat' => $cat])
                ->render();
        }
        return false;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getArticlesByDate(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'day' => 'integer|required|between:1,31',
                'month' => 'integer|required|between:0,11',
                'year' => 'integer|required|between:2017,2050',
            ]);

            if ($validator->fails()) {
                return '';
            }

            $data = $request->except('_token');

            $day = $data['day'] ?? 1;
            $month = 1 + ($data['month'] ?? 0);
            $year = $data['year'] ?? 2017;

            $where = [
                ['approved', true],
                ['created_at', '<=', date('Y-m-d H:i:s', mktime(23, 59, 59, $month, $day, $year))],
                ['created_at', '>=', date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year))]
            ];

            $articles = $this->a_rep
                ->getTops(['image', 'category'], $where, false, false, ['created_at', 'desc'], 12);

            return view('static.get_articles')
                ->with(['articles' => $articles])
                ->render();
        }
        return '';
    }
}
