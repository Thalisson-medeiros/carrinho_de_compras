<?php
//arquivo para configurar as rotas do framework

namespace App;
use MF\Init\Bootstrap;

class Routes extends Bootstrap
{
    protected function initRoutes(): void
    {
        $route['home'] = [
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        ];

        $route['tabelaProdutos'] = [
            'route' => '/tabelaProdutos',
            'controller' => 'IndexController',
            'action' => 'tabelaProdutos'
        ];

        $route['adicionar'] = [
            'route' => '/adicionar',
            'controller' => 'CarrinhoController',
            'action' => 'adicionar'
        ];

        $route['remover'] = [
            'route' => '/remover',
            'controller' => 'CarrinhoController',
            'action' => 'remover'
        ];

        $route['atualizar'] = [
            'route' => '/atualizar',
            'controller' => 'CarrinhoController',
            'action' => 'atualizar'
        ];

        $this->setRoutes($route);
    }
}