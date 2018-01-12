<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Poll;
use Fresh\Nashemisto\PollStatistic;
use Gate;
use Image;
use File;
use Config;
use DB;

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
        $poll['description'] = strip_tags($data['description'], '<p>');
        $poll['answer1'] = $data['answer1'];
        $poll['answer2'] = $data['answer2'];
        $poll['answer3'] = $data['answer3'];
        $poll['answer4'] = $data['answer4'];
        $poll['answer5'] = $data['answer5'];
        $poll['alt'] = $data['alt'];
        $poll['imgtitle'] = $data['imgtitle'];

        if (!empty($data['confirmed'])) {
            if (Gate::allows('CONFIRMATION_DATA')) {
                $poll['approved'] = 1;
            }
        }

        if (!empty($data['outputtime'])) {
            $poll['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }

        // Main Image handle
        if ($request->hasFile('img')) {
            $path = $this->mainImg($request->file('img'), $poll['alias']);

            if (false === $path) {
                $error[] = ['img' => 'Помилка завантаження зображення'];
            } else {
                $poll['image'] = $path;
            }
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
        $poll['description'] = strip_tags($data['description'], '<p>');
        $poll['answer1'] = $data['answer1'];
        $poll['answer2'] = $data['answer2'];
        $poll['answer3'] = $data['answer3'];
        $poll['answer4'] = $data['answer4'];
        $poll['answer5'] = $data['answer5'];
        $poll['alt'] = $data['alt'];
        $poll['imgtitle'] = $data['imgtitle'];

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

        // Main Image handle
        if ($request->hasFile('img')) {
            $old_img = $poll->image;
            $path = $this->mainImg($request->file('img'), $poll['alias']);

            if (false === $path) {
                $error[] = ['img' => 'Помилка завантаження зображення'];
            } else {
                $poll['image'] = $path;
            }

            //DELETE OLD IMAGE
            $this->deleteOldImage($old_img);
        }

        $res = $poll->save();
        return $res;
    }

    protected function clearPollsCache()
    {
//        Cache::forget('main');
        /*
        !empty($id) ? Cache::store('file')->forget('patients_article-' . $id) : null;
        */

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
                $answer = 'poll1';
                break;
            case 'poll2':
                $res->increment('n2');
                $answer = 'poll2';
                break;
            case 'poll3':
                $res->increment('n3');
                $answer = 'poll3';
                break;
            case 'poll4':
                $res->increment('n4');
                $answer = 'poll4';
                break;
            case 'poll5':
                $res->increment('n5');
                $answer = 'poll5';
                break;
            default:
                $res->increment('n1');
                $answer = 'poll1';
        }

        $stats['n1'] = $res->n1 ?? 0;
        $stats['n2'] = $res->n2 ?? 0;
        $stats['n3'] = $res->n3 ?? 0;
        $stats['n4'] = $res->n4 ?? 0;
        $stats['n5'] = $res->n5 ?? 0;

        return ['poll' => $poll, 'stats' => $stats, 'answer' => $answer];
    }

    /**
     * @param $image
     * @param $alias
     * @return bool|string
     */
    public function mainImg($image, $alias)
    {
        if ($image->isValid()) {

            $path = substr($alias, 0, 64) . '-' . time() . '.jpeg';

            $img = Image::make($image);

            $img->resize(Config::get('settings.poll')['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path() . '/asset/images/polls/' . $path, 100);

            return $path;
        } else {
            return false;
        }
    }

    /**
     * @param $path
     * @return bool
     */
    public function deleteOldImage($path)
    {
        if (File::exists(public_path('/asset/images/polls/') . $path)) {
            File::delete(public_path('/asset/images/polls/') . $path);
        }
        return true;
    }

    public function getPollsPreview($id)
    {
        $result = $this->get(
            ['question', 'alias', 'description', 'image', 'alt', 'imgtitle', 'created_at', 'id'], 3, false,
            [['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['id', '<>', $id]],
            ['created_at', 'desc']
        );

        $result = $this->countVoites($result);

        return $result;

    }

    public function countVoites($result)
    {
        if ($result) {
            $result->transform(function ($item) {

                $item->voited = $item->voting($item->id);

                return $item;

            });
        }
        return $result;
    }
}