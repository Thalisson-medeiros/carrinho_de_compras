<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
    public function index(): void
    {
        $produtos = Container::getModel('produtos');
        $this->view->produtos = $produtos->buscarTodosOsProdutos();

        $this->render('index');
    }

    public function tabelaProdutos(): void
    {
        $carrinho = Container::getModel('carrinho');
        $this->view->carrinho = $carrinho->buscarTodosOsProdutosDoCarrinho();
        $this->view->subtotal = $carrinho->calculaSubtotal();
        
        $this->render('tabelaProdutos');
    }

    //criar as funções de atualizar e remover;
}