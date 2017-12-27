<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Cache;
use DB;
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
        ChannelsRepository $channelsRepository
    )
    {
        $this->poll_rep = $poll;
        $this->a_rep = $arep;
        $this->c_rep = $cats;
        $this->ch_rep = $channelsRepository;
    }

    /***
     * @return $this
     */
    public function show()
    {
//        session()->flush();
        $this->title = 'Головна';
        $poll = $this->poll_rep->getNewest();
        $this->jss = '
            <script src="' . asset('js/video.js') . '"></script>
            <script src="' . asset('js/categories.js') . '"></script>
            ';

        if (empty(session('poll_id_' . $poll->id))) {
            $this->jss .= '<script src="' . asset('js/poll.js') . '"></script>';
            $statistic = null;
        } else {
            $statistic = PollStatistic::where(['poll_id' => $poll->id])->first();
        }

        $channels = Cache::remember('main-channels', 60, function () {
            return $this->ch_rep->get('*', 7, false, ['approved' => 1], false, ['videos']);
        });


        $where = [['approved', true], ['created_at', '<=', DB::raw('NOW()')]];
        $articles = $this->a_rep->get('*', 12, false, $where, ['created_at', 'desc'], ['image', 'category']);

        $articles = $this->a_rep->contentHandle($articles);
        $cats = $this->c_rep->get(['name', 'alias', 'id'], 5, false, ['approved' => 1]);
        //dd($articles);
        $this->poll = view('static.poll')->with(['poll' => $poll, 'statistic' => $statistic])->render();
        $this->content = view('static.main')
            ->with(['articles' => $articles, 'categories' => $cats, 'channels' => $channels])
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


            $articles = $this->a_rep->get('*', 12, false, $where, ['created_at', 'desc'], ['image', 'category']);
            $articles = $this->a_rep->contentHandle($articles);

            return view('static.get_articles')
                ->with(['articles' => $articles, 'cat' => $cat])
                ->render();
        }
        return false;
    }
}
