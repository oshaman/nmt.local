<?php

namespace Fresh\Nashemisto\Repositories;

use Validator;
use Cache;

class ArticleSeoRepository extends Repository
{
    /**
     * @param $request
     * @param $article
     * @return array
     */
    public function updateSeo($request, $article)
    {
        $validator = Validator::make($request->all(), [
            'seo_title' => 'string|max:255|nullable',
            'seo_keywords' => 'string|max:255|nullable',
            'seo_description' => 'string|max:255|nullable',
            'og_image' => 'string|max:255|nullable',
            'og_title' => 'string|max:255|nullable',
            'og_description' => 'string|max:255|nullable',
            'seo_text' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->except('_token');

        if (null == $article->seo) {
            $result = $article->seo()
                ->create(['seo_title' => $data['seo_title'], 'seo_keywords' => $data['seo_keywords'],
                    'seo_description' => $data['seo_description'], 'og_image' => $data['og_image'],
                    'og_title' => $data['og_title'],
                    'og_description' => $data['og_description'], 'seo_text' => $data['seo_text']]);
        } else {
            $result = $article->seo()
                ->update(['seo_title' => $data['seo_title'], 'seo_keywords' => $data['seo_keywords'],
                    'seo_description' => $data['seo_description'], 'og_image' => $data['og_image'],
                    'og_title' => $data['og_title'],
                    'og_description' => $data['og_description'], 'seo_text' => $data['seo_text']]);
        }

        if (false != $result) {
            Cache::forget('article_' . $article->alias);
            return ['status' => 'Дані оновлені'];
        } else {
            return ['error' => 'Помилка оновлення'];
        }
    }
}