<?php

namespace App\Models;
use MF\Model\Model;
use PDOException;

class Produtos extends Model
{
    public function buscarProduto(string $codigo): array | null
    {
        try{
            $sql = 'select cod, nome, preco, imagem from tb_produtos where cod = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $codigo);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);

        }catch(PDOException $error){
            return null;
        }
    }

    public function buscarTodosOsProdutos(): array
    {
        try{
            $sql = 'select cod, nome, preco, imagem from tb_produtos';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }catch(PDOException $error){
            return null;
        }
    }
}