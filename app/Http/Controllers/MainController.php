<?php

namespace Fresh\Nashemisto\Http\Controllers;

class MainController extends Controller
{
    protected $template = 'layouts.index';
    protected $content = false;
    protected $lastModified = false;
    protected $title;
    protected $vars;
    protected $css = null;
    protected $jss = null;
    protected $aside = null;
    protected $poll = null;

    protected $seo = null;

    /**
     * @return $this
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'jss', $this->jss);
        $this->vars = array_add($this->vars, 'css', $this->jss);


//============================== Header =====================================
        $header = view('layouts.header')->render();
        $this->vars = array_add($this->vars, 'header', $header);
//============================== Header =====================================
//============================== Footer =====================================

        $footer = view('layouts.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);
//============================== Footer =====================================
        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        if ($this->poll) {
            $this->vars = array_add($this->vars, 'poll', $this->poll);
        }

        if (empty($this->seo)) {
            $this->seo = new \stdClass();
            $this->seo->seo_keywords = env('APP_NAME');
            $this->seo->seo_description = env('APP_NAME');
            $this->seo->og_title = env('APP_NAME');
            $this->seo->og_description = env('APP_NAME');
            $this->seo->seo_title = '';
        }
        $this->vars = array_add($this->vars, 'seo', $this->seo);

        if ($this->aside) {
            $this->vars = array_add($this->vars, 'aside', $this->aside);
        }

        if ($this->lastModified) {
            $content = view($this->template)->with($this->vars);
            return response($content)->header('Last-Modified', $this->lastModified);
        }
        return view($this->template)->with($this->vars);
    }


    public function getMenu($status = false)
    {
        /*if ($status) {
            $cats = Menus::with('category')->where('own', 'ua')->get();
        } else {
            $cats = Menus::with('category')->where('own', 'ru')->get();
        }

        return Menu::make('menu', function ($menu) use ($cats, $status) {
            foreach ($cats as $cat) {
                $route = $status ? 'ua_' : '';
                $title = $status ? 'u' : '';
                $menu->add(str_limit($cat->category->{$title . 'title'}, 32), ['route' => [$route . 'articles_cat', $cat->category->alias]]);
            }
        });*/
    }


}
