<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\StaticPage;
use Validator;
use Cache;

class StaticPageRepositiory extends Repository
{
    /**
     * construct
     */
    public function __construct(StaticPage $rep)
    {
        $this->model = $rep;
    }

    /**
     * @param $request
     * @param $advertising
     * @return array
     */
    public function updateStaticPage($request, $static_page)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string',
            'title' => 'required|string'
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }
        $data = $request->except('_token');
        $static_page->title = $data['title'];
        $static_page->text = $data['text'];


        try {
            $static_page->save();
        } catch (Exception $e) {
            \Log::info('Ошибка записи static_page: ', $e->getMessage());
            $error[] = ['static_page' => 'Помилка збереження сторінки'];
            return $error;
        }

        Cache::forget('pro-nas');
        return ['status' => 'Сторінку збережено.'];
    }
}