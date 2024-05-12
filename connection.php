<?php

class Connection
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO(
            'mysql:host=localhost;dbname=dbCart;charset=utf8;', 'root', ''
        );
    }

    public function addItem(string $item, float $price): void
    {
        try{
            $sql = "insert into cart (name, price) values (?, ?)";
    
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $item);
            $stmt->bindValue(2, $price);
            $stmt->execute();
    
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getItems(): array
    {
        try{
            $sql = 'select name, price from cart';
        
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getQuantityItemsInCart(): int
    {
        try{
            $sql = 'select count(price) from cart';
        
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_COLUMN);
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getQuantityOfOneItem(string $name): int
    {
        try{
            $sql = 'select count(name) from cart where name = ?';
        
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $name);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_COLUMN);
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

$conn = new Connection;

if(isset($_GET['item'])){
    $conn->addItem($_GET['item'], $_GET['price']);
    header('Location:index.php');
}