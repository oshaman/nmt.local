<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Video;
use Gate;
use Validator;
use Cache;
use DB;

class VideosRepository extends Repository
{
    /**
     * ArticlesRepository constructor.
     * @param Video $rep
     */
    public function __construct(Video $rep)
    {
        $this->model = $rep;
    }

    /**
     * @param $request
     * @return Result array
     */
    public function addVideo($request)
    {
        $data = $request->except('_token');

        $video['title'] = $data['title'];

        $video['token'] = $data['token'];
        $video['channel_id'] = $data['channel'];


        if (!empty($data['confirmed'])) {
            if (Gate::allows('CONFIRMATION_DATA')) {
                $video['approved'] = 1;
            }
        }


        if (!empty($data['outputtime'])) {
            $video['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }

//        END Content
        $new = $this->model->firstOrCreate($video);

        $this->clearVideoCache(false, $new->channel_id);
        return ['status' => 'Відео додано', 'id' => $new->id];

    }

    /**
     * @param $request
     * @param $video
     * @return array
     */
    public function updateVideo($request, $video)
    {
        $data = $request->except('_token');

        $video['title'] = $data['title'];

        $video['token'] = $data['token'];
        $video['channel_id'] = $data['channel'];

        if (Gate::allows('CONFIRMATION_DATA')) {
            if (!empty($data['confirmed'])) {
                $video['approved'] = 1;
            } else {
                $video['approved'] = 0;
            }
        }

        if (!empty($data['outputtime'])) {
            $video['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }

//        END Content
        $video->save();

        $this->clearVideoCache(false);
        return ['status' => 'Відео оновленне', 'id' => $video->id];
    }

    /**
     * @param $video
     * @return array
     */
    public function deleteVideo($video)
    {
        if (Gate::denies('CONFIRMATION_DATA')) {
            abort(404);
        }

        if ($video->delete()) {

            $this->clearVideoCache();

            return ['status' => 'Відео видалене'];
        }
    }

    /**
     * Clear
     */
    protected function clearVideoCache($id = false, $channel_id = false)
    {
        Cache::forget('main-channels');
//        !empty($channel_id) ? Cache::forget('channel_' . $channel_id) : null;
        /*
        !empty($id) ? Cache::store('file')->forget('patients_article-' . $id) : null;*/

    }

}
