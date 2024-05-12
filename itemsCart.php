<?php 
    require_once 'connection.php'; 

    //elimina os repetidos
    $array = [];
    foreach ($conn->getItems() as $chave => $item) {
        if(!in_array($item, $array)){
            $array[] = $item;
        }
    }

    //pega a quantidade de cada item 
    foreach ($array as $key => $value) {
        $quantityOfOneItem[] = $conn->getQuantityOfOneItem($value['name']);
    }
?>

<table border="1">
    <thead>
        <th>nome</th>
        <th>price</th>
    </thead>
    <tbody>
        <? foreach($array as $key => $item) {?>
        
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $quantityOfOneItem[$key] ?></td>
            </tr>
            
        <? } ?>
    </tbody>
</table>