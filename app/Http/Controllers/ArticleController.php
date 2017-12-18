<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends MainController
{
    public function main(Request $request)
    {
        return $this->renderOutput();
    }
}
