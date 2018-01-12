<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Category;
use Fresh\Nashemisto\Priority;
use Gate;

class PriorityRepository extends Repository
{

    /**
     * PriorityRepository constructor.
     * @param Priority $priority
     */
    public function __construct(Priority $priority)
    {
        $this->model = $priority;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updatePriority($request, $priority)
    {
        return $priority->fill($request->only(['top1', 'top2', 'top3']))->save();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getPriority($request)
    {
        $cat = Category::where('id', $request->input('category'))->first();

        if (null != $cat) {
            $cat_id = $cat->id;
        } else {
            $cat_id = 10000;
        }

        return Priority::firstOrCreate(['cat_id' => $cat_id]);
    }

    public function getTop($id)
    {
        $priority = $this->model->select('top1', 'top2', 'top3')->where('cat_id', $id)->first();
        if (null == $priority) {
            return false;
        } else {
            return array_flatten(array_filter($priority->toArray()));
        }
    }
}