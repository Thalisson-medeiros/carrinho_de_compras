<?php 

namespace App;

class Connection
{
    private const HOST = 'localhost';
    private const DBNAME = 'carrinho_de_compras';
    private const CHARSET = 'utf8';
    private const USER = 'root';
    private const PASSWORD = '';

    public static function getDb(): \PDO
    {
        try{
            $conn = new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DBNAME.";charset=".self::CHARSET, self::USER, self::PASSWORD
            );
            return $conn;

        }catch(\PDOException $e){
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}