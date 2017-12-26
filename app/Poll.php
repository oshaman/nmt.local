<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'title', 'alias', 'description', 'question',
        'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'approved', 'created_at'
    ];
}
