<?php
/**
 * Created by PhpStorm.
 * User: ххх
 * Date: 02.02.2018
 * Time: 10:02
 */

namespace Fresh\Nashemisto\Repositories;

use Config;
use Fresh\Nashemisto\Article;

class SearchRepository extends Repository
{
    protected $article;

    /***
     * SearchRepository constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function getSearch($request)
    {
        if ($request->filled('stats') || !$request->filled('value')) {
            return ['error' => 'За вашим запитом нічого не знайдено'];
        }

        $re = '#[^\w\'\sа-яА-ЯёЁіІїЇЄє\-]+#u';

        $query = preg_replace($re, '', $request->get('value'));
        $query = substr(preg_replace('#[\s{2,}]#', ' ', $query), 0, 96);

        if (empty($query)) {
            return ['error' => 'За вашим запитом нічого не знайдено'];
        }

//        $query_f = '"' . $query . '"';
        $match = 'title, content, preview';
        $articles = $this->article->select('*')->whereRaw(
            "MATCH($match) AGAINST(? IN BOOLEAN MODE)",
            array($query)
        )->with(['image', 'category'])->paginate(Config::get('settings.paginate_tags'));


        if ($articles->isNotEmpty()) {
            $result = $this->check($articles, true);
        } else {
            $result = false;
        }

        return $result;
    }
}