<?php

namespace MF\Init;

abstract class Bootstrap
{
    protected array $routes;

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    public function setRoutes($route): void
    {
        $this->routes = $route;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    protected function run($url): void
    {
        foreach($this->getRoutes() as $key => $route){
            if($route['route'] == $url){
                $class = "App\\Controllers\\".ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
        }
    }

    public function getUrl(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}