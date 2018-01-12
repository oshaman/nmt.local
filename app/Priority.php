<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = ['cat_id', 'top1', 'top2', 'top3'];
}
