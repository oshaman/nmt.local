<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'token', 'channel_id', 'created_at', 'approved'];
}