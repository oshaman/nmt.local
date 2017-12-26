<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $fillable = ['title', 'text', 'own'];
}
