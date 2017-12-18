<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Controllers\Controller;
use Menu;
use Gate;
use Auth;

class AdminController extends Controller
{
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars;
    protected $jss = null;
    protected $css = null;
    protected $tiny = false;
    protected $areaH = false;
    protected $areaW = false;
    /**
     * @return mixed
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'jss', $this->jss);
        $this->vars = array_add($this->vars, 'tiny', $this->tiny);
        $this->vars = array_add($this->vars, 'css', $this->css);

        if (!empty($this->areaH)) $this->vars = array_add($this->vars, 'areaH', $this->areaH);
        if (!empty($this->areaW)) $this->vars = array_add($this->vars, 'areaW', $this->areaW);

        $menu = $this->getMenu();

        $navigation = view('admin.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'nav', $navigation);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }
    /**
     * @return mixed
     */
    public function getMenu()
    {
        return Menu::make('adminMenu', function ($menu) {

            if (Gate::allows('USERS_ADMIN')) {
                $menu->add('Користувачі', array('route' => 'users_admin'));
            }

            if (Gate::allows('UPDATE_ARTICLES')) {
                $menu->add('Редагування статей',array('route' => 'admin_articles'));
            }

            if (Gate::allows('UPDATE_ARTICLES')) {
                $menu->add('Теги',array('route' => 'admin_tags'));
            }

            /*

            if (Gate::allows('MAIN_ADMIN')) {
                $menu->add('Главная страница', array('route' => 'main_admin'));
            }

            if (Gate::allows('STATIC_ADMIN')) {
                $menu->add('Статичные страницы', 'admin/static');
            }

            if (Gate::allows('STATIC_ADMIN')) {
                $menu->add('Статистика', route('stats_medicine'));
            }*/
            /*if (Gate::allows('USERS_ADMIN')) {
                $menu->add('test', array('route' => 'presearch'));
            }*/
        });
    }
}
