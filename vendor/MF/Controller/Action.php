<?php

namespace MF\Controller;

abstract class Action
{
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass;
        session_start();
    }

    protected function render(string $view, string $layout = 'layout'): void
    {
        $this->view->page = $view;

        if(file_exists("../App/Views/". $layout .".phtml")){
            require_once "../App/Views/". $layout .".phtml";
        }else{
            $this->content();
        }
    }

    protected function content(): void
    {
        $className = str_replace('App\\Controllers\\', '', get_class($this));
        $className = strtolower(str_replace('Controller', '', $className));

        require_once "../App/Views/". $className . "/" . $this->view->page . ".phtml";
    }

    
}