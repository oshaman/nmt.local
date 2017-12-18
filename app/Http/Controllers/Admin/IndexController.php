<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

class IndexController extends AdminController
{
    public function show()
    {
        $this->content = 'IndexC';
        $this->template = 'admin.admin';
        $this->title = 'ADMIN';

        return $this->renderOutput();
    }
}
