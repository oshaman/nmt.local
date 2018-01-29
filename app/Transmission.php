<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    protected $fillable = ['title', 'token', 'approved'];
}
