<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'alias', 'approved'];

    public function videos()
    {
        return $this->hasMany('Fresh\Nashemisto\Video');
    }
}
