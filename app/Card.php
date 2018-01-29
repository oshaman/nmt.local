<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['title', 'created_at', 'approved'];
}
