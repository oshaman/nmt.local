<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Channel;
use Cache;

class ChannelsRepository extends Repository
{


    public function __construct(Channel $channel)
    {
        $this->model = $channel;
    }

    /**
     * Create new Category
     * @param $request
     * @return bool
     */
    public function addChannel($request)
    {
        $data = $request->except('_token');

        $res = $this->model->fill($data)->save();
        $this->clearCahnnelCache();
        return $res;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateChannel($request, $channel)
    {
        if ($channel->title != $request->title) {
            $channel->title = $request->title;
        }

        if ($channel->alias != $request->alias) {
            $channel->alias = $request->alias;
        }

        if ($request->filled('confirmed')) {
            $channel->approved = 1;
        } else {
            $channel->approved = 0;
        }

        $res = $channel->save();
        $this->clearCahnnelCache();
        return $res;
    }

    /**
     * @return array
     */
    public function channelSelect()
    {
        $channels = $this->model->select(['title', 'id'])->get();
        $lists = array();
        foreach ($channels as $channel) {
            $lists[$channel->id] = $channel->title;
        }
        return $lists;
    }

    protected function clearCahnnelCache($id = false)
    {
        Cache::forget('main-channels');
    }


}

?>