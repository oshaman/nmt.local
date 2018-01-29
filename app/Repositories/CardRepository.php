<?php
/**
 * Created by PhpStorm.
 * User: ххх
 * Date: 26.01.2018
 * Time: 17:43
 */

namespace Fresh\Nashemisto\Repositories;


use Fresh\Nashemisto\Card;

class CardRepository extends Repository
{
    /**
     * CardRepository constructor.
     * @param Card $rep
     */
    public function __construct(Card $rep)
    {
        $this->model = $rep;
    }

    /**
     * @param $request
     * @return bool
     */
    public function addCard($request)
    {
        $data['title'] = $request->get('title');

        if ($request->has('confirmed')) {
            $data['approved'] = 1;
        }

        if (!empty($request->get('outputtime'))) {
            $data['created_at'] = date('Y-m-d H:i:s', strtotime($request->get('outputtime')));
        }

        $result = $this->model->fill($data)->save();

        $this->clearCardCache();
        return $result;
    }

    /**
     * @param $request
     * @param $card
     * @return mixed
     */
    public function updateCard($request, $card)
    {
        $data['title'] = $request->get('title');

        if ($request->has('confirmed')) {
            $data['approved'] = 1;
        } else {
            $data['approved'] = 0;
        }

        if (!empty($request->get('outputtime'))) {
            $data['created_at'] = date('Y-m-d H:i:s', strtotime($request->get('outputtime')));
        }

        $result = $card->fill($data)->save();

        $this->clearCardCache();
        return $result;
    }

    /**
     * @param $card
     * @return array|bool
     */
    public function deleteCard($card)
    {
        if ($card->delete()) {

            $this->clearCardCache();

            return ['status' => 'Анонс видалено'];
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function clearCardCache()
    {
        return true;
    }
}