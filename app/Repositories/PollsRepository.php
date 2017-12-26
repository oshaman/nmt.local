<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Poll;
use Fresh\Nashemisto\PollStatistic;
use Gate;

class PollsRepository extends Repository
{


    public function __construct(Poll $poll)
    {
        $this->model = $poll;

    }

    /**
     * Create new Tag
     * @param $request
     * @return bool
     */
    public function addPoll($request)
    {
        $data = $request->except('_token');

        $poll['title'] = $data['title'];
        $poll['alias'] = $data['alias'];
        $poll['question'] = $data['question'];
        $poll['description'] = $data['description'];
        $poll['answer1'] = $data['answer1'];
        $poll['answer2'] = $data['answer2'];
        $poll['answer3'] = $data['answer3'];
        $poll['answer4'] = $data['answer4'];
        $poll['answer5'] = $data['answer5'];

        if (!empty($data['confirmed'])) {
            if (Gate::allows('CONFIRMATION_DATA')) {
                $poll['approved'] = 1;
            }
        }

        if (!empty($data['outputtime'])) {
            $poll['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }

        $res = $this->model->fill($poll)->save();

        return $res;
    }

    public function updatePoll($request, $poll)
    {
        $data = $request->except('_token');

        $poll['title'] = $data['title'];
        $poll['alias'] = $data['alias'];
        $poll['question'] = $data['question'];
        $poll['description'] = $data['description'];
        $poll['answer1'] = $data['answer1'];
        $poll['answer2'] = $data['answer2'];
        $poll['answer3'] = $data['answer3'];
        $poll['answer4'] = $data['answer4'];
        $poll['answer5'] = $data['answer5'];

        if (Gate::allows('CONFIRMATION_DATA')) {
            if (!empty($data['confirmed'])) {
                $poll['approved'] = 1;
            } else {
                $poll['approved'] = 0;
            }
        }

        if (!empty($data['outputtime'])) {
            $poll['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }


//        dd($poll);
        $res = $poll->save();
        return $res;
    }

    /**
     * @param $poll
     * @return array
     */
    /*public function deletePoll($poll)
    {
        if($poll->delete()) {
            return ['status' => trans('Опитування видалене')];
        }

    }*/

    public function addToPolls($request)
    {
        $data = $request->only('selects', 'poll-id');

        if (!empty(session('poll_id_' . $data['poll-id']))) {
            return ['poll' => false, 'stats' => false];
        }

        $poll = $this->model->find((int)$data['poll-id']);

        if (null == $poll) {
            return ['poll' => false, 'stats' => false];
        }

        $statistic = new PollStatistic();
        $res = $statistic->firstOrCreate(['poll_id' => $poll->id]);

        switch ($data['selects']) {
            case 'poll1':
                $res->increment('n1');
                break;
            case 'poll2':
                $res->increment('n2');
                break;
            case 'poll3':
                $res->increment('n3');
                break;
            case 'poll4':
                $res->increment('n4');
                break;
            case 'poll5':
                $res->increment('n5');
                break;
            default:
                $res->increment('n1');
        }

        return ['poll' => $poll, 'stats' => $res];

    }
}