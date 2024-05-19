<?php

namespace App\Models;
use MF\Model\Model;
use PDOException;

class Carrinho extends Model 
{
   public function adicionarProduto(int $codigo, string $nome, float $preco, string $imagem): string
   {
      try{
         $sql = 'insert into tb_carrinho (cod, nome, preco, imagem, quantidade, sessao) 
               values 
            (?, ?, ?, ?, ?, ?)';
         
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(1, $codigo);
         $stmt->bindValue(2, $nome);
         $stmt->bindValue(3, $preco);
         $stmt->bindValue(4, $imagem);
         $stmt->bindValue(5, 1);
         $stmt->bindValue(6, session_id());
         $stmt->execute();
         return 'SIM';

      }catch(PDOException $error){
         return 'NÃO';
      }
   }

   public function verificaSeOProdutoJaEstaNoCarrinho(int $codigo): bool
   {
      try{
         $sql = 'select cod, nome, preco, imagem from tb_carrinho where cod = ?';         
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(1, $codigo);
         $stmt->execute();
         
         if(!empty($stmt->fetchAll(\PDO::FETCH_ASSOC))){
            return true;
         }else{
            return false;
         }

      }catch(PDOException $error){
         return false;
      }
   }

   public function buscarTodosOsProdutosDoCarrinho(): array | bool
   {
      try{
         $sql = 'select cod, nome, preco, imagem, quantidade, subtotal from tb_carrinho';         
         $stmt = $this->db->prepare($sql);
         $stmt->execute();
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);

      }catch(PDOException $error){
         return false;
      }     
   }

   public function excluirProdutoDoCarrinho(int $codigo): string
   {
      try{
         $sql = 'delete from tb_carrinho where cod = ?';         
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(1, $codigo);
         $stmt->execute();
         return 'DELETADO';

      }catch(PDOException $error){
         return 'ERRO';
      }
   }

   public function atualizarCarrinho(string $acao, int $codigo)
   {
      $quantidade = $this->buscarQuantidadeDeUmProduto($codigo);
      
      if(!empty($quantidade) && $quantidade != false){

         if($acao == 'decrementar' && $quantidade['quantidade'] > 0){
            $quantidade['quantidade'] -= 1;

         }else if($acao == 'incrementar'){
            $quantidade['quantidade'] += 1;
         }
   
         try{
            $sql = 'update tb_carrinho set quantidade = ? where cod = ?';         
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $quantidade['quantidade']);
            $stmt->bindValue(2, $codigo);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
   
         }catch(PDOException $error){
            return false;
         }

      }else{
         return false;
      }
   }

   public function buscarQuantidadeDeUmProduto(int $codigo): array | bool
   {
      try{
         $sql = 'select quantidade from tb_carrinho where cod = ?';         
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(1, $codigo);
         $stmt->execute();
         return $stmt->fetch(\PDO::FETCH_ASSOC);

      }catch(PDOException $error){
         return false;
      }
   }

   public function calculaSubtotal(): float | bool
   {
      try{
         $sql = 'select quantidade, preco from tb_carrinho';         
         $stmt = $this->db->prepare($sql);
         $stmt->execute();
         
         $subtotal = 0;

         foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $id => $valor){
            $subtotal += $valor['preco'] * $valor['quantidade'];
         }

         return $subtotal;

      }catch(PDOException $error){
         return false;
      }
   }
}
