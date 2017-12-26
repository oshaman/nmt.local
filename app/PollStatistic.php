<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class PollStatistic extends Model
{
    protected $fillable = ['poll_id', 'n1', 'n2', 'n3', 'n4', 'n5'];
}
