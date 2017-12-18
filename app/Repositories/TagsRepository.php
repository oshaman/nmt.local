<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Tag;
use Gate;

class TagsRepository extends Repository {


    public function __construct(Tag $tag) {
        $this->model = $tag;
    }

    /**
     * Create new Tag
     * @param $request
     * @return bool
     */
    public function addTag($request)
    {
        $data = $request->except('_token');

        $tag['name'] = $data['tag'];
        $tag['alias'] = $data['alias'];

        $res = $this->model->fill($tag)->save();

        return $res;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateTag($request, $tag)
    {
        $tag->name = $request->tag;
        $tag->alias = $request->alias;

        $res = $tag->save();
        return $res;
    }

    public function deleteTag($tag)
    {
        if($tag->delete()) {
            return ['status' => trans('Тег видалений')];
        }

    }
    /**
     *
     * @return tags array
     */
    public function tagSelect()
    {
        $tags = $this->model->select(['name', 'id'])->get();
        $lists = array();

        foreach($tags as $tag) {
            $lists[$tag->id] = $tag->name;
        }
        return $lists;
    }

}

?>