<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show()
    {
        return view('static.video')->render();
    }
}
