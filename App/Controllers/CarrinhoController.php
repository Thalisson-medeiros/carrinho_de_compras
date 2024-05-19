<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class CarrinhoController extends Action
{
    public function adicionar(): void
    {
        //verificar se o produto existe na 'loja'
        $produtos = Container::getModel('produtos');
        $produto = $produtos->buscarProduto($_GET['codigo']);

        if($produto != null){
            $carrinho = Container::getModel('carrinho');

            //verifica se o 'cliente' já possui este produto em seu carrinho.
            $verifica = $carrinho->verificaSeOProdutoJaEstaNoCarrinho($produto['cod']);

            if(!$verifica){
                //insere este produto no carrinho
                $resposta = $carrinho->adicionarProduto($produto['cod'],$produto['nome'],$produto['preco'],$produto['imagem']);
            }
        }
        
        header('Location:/?resposta='.$resposta);
    }

    public function remover(): void
    {
        $carrinho = Container::getModel('carrinho');
        $resposta = $carrinho->excluirProdutoDoCarrinho($_GET['remover']);

        header('Location:/tabelaProdutos?resposta='.$resposta);
    }

    public function atualizar(): void
    {
        $carrinho = Container::getModel('carrinho');
        $carrinho->atualizarCarrinho($_GET['acao'], $_GET['codigo']);
        
        header('Location:/tabelaProdutos');
    }
}