<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'alias'];

    public function articles()
    {
        return $this->belongsToMany('Fresh\Nashemisto\Article', 'article_tag');
    }
}
