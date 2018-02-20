<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Informer extends Model
{
    protected $fillable = ['text'];
    public $timestamps = false;
}
