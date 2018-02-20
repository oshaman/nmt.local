<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'alias', 'approved', 'priority'];

    public function videos()
    {
        return $this->hasMany('Fresh\Nashemisto\Video')->orderBy('created_at', 'desc');
    }
}
