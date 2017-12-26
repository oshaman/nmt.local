<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'alias', 'approved'];

    public function articles()
    {
        return $this->belongsToMany('Fresh\Nashemisto\Article');
    }
}
