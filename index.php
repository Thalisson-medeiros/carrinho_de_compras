<?php
    require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Carrinho</title>
</head>
<body>
    <a href="/itemsCart.php" class="cart">
        <h3>Carrinho</h3>
        <div class="cart-number"><?= $conn->getQuantityItemsInCart() ?></div>
    </a>

    <hr>

    <section class="products">
        <a href="/connection.php?item=bermuda&price=29.90" class="product">
            <h2>bermuda</h2>
            <h2>29.90</h2>
        </a>

        <a href="/connection.php?item=camisa&price=19.90" class="product">
            <h2>camisa</h2>
            <h2>19.90</h2>
        </a>

        <a href="/connection.php?item=calça&price=99.90" class="product">
            <h2>calça</h2>
            <h2>99.90</h2>
        </a>
    </section>
</body>
</html>