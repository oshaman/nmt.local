<?php

namespace Fresh\Nashemisto\Repositories;

use Config;

abstract class Repository
{

    protected $model = false;

    /**
     * @param string $select
     * @param bool $take
     * @param bool $pagination
     * @param bool $where
     * @param bool $order
     * @param bool $with
     * @return bool
     */
    public function get($select = '*', $take = false, $pagination = false, $where = false, $order = false, $with = false)
    {
        $builder = $this->model->select($select);

        if ($with) {
            $builder = $this->model->with($with);
        }

        if ($take) {
            $builder->take($take);
        }

        if ($where) {
            $builder->where($where);
        }

        if ($order) {
            $builder->orderBy($order[0], $order[1]);
        }

        if ($pagination) {
            if (true === $pagination) {
                $pagination = 14;
            }
            return $this->check($builder->paginate($pagination));
        }

//        return $builder->get();
        return $this->check($builder->get());
    }

    /**
     * @param $result
     * @return bool
     */
    protected function check($result)
    {

        if ($result->isEmpty()) {
            return FALSE;
        }

        $result->transform(function ($item) {

            if ($item->created_at) {
                $created = strtotime($item->created_at);

                $item->date = date('d.m.Y', $created);
                $item->time = date('H:i', $created);
            }

            /*            if (is_string($item->seo) && is_object(json_decode($item->seo)) && (json_last_error() == JSON_ERROR_NONE)) {
                            $item->seo = json_decode($item->seo);
                        }*/

            return $item;

        });

        return $result;

    }

    /**
     * @param $alias
     * @param array $attr
     * @return mixed
     */
    public function one($alias, $attr = array())
    {
        $result = $this->model->where('alias', $alias)->first();

        return $result;
    }

    /**
     * @param $id
     * @param array $attr
     * @return mixed
     */
    public function findById($id, $attr = array())
    {
        $result = $this->model->where('id', $id)->first();

        return $result;
    }

    /**
     * @param $string
     * @return mixed|string
     */
    public function transliterate($string)
    {
        $str = mb_strtolower($string, 'UTF-8');

        $leter_array = array(
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        );

        foreach ($leter_array as $leter => $kyr) {
            $kyr = explode(',', $kyr);

            $str = str_replace($kyr, $leter, $str);
        }

        //  A-Za-z0-9-
        $str = preg_replace('/(\s|[^A-Za-z0-9\-_])+/', '-', $str);

        $str = trim($str, '-');

        return $str;
    }

    /**
     * @param $date
     * @return false|string
     */
    public function convertDate($article)
    {
        $article->date = date('d.m.Y', strtotime($article->created_at));
        $article->time = date('H:i', strtotime($article->created_at));

        return $article;
    }

    public function getNewest()
    {
        return $this->model->latest()->first();
    }
}