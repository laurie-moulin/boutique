<?php

require_once '../class/product.php';
require_once '../class/dataBase.php';

$product = new \db\product();


//$product->setCategory();
//    $product['categ_product'];

var_dump($product->setCategory());
var_dump($product->getSize());
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Admin update</title>
</head>

<body>

<header>

</header>

<main>

<!--    //RECAP ARTICLE ! -->

    <?php foreach ($product->setProduct() as $product) { ?>
        NOM : <?= $product['nom'] ?><br>
        ID : <?= $product['id_product'] ?><br>
        <img width="300px" src="../img/imgboutique/<?= $product['photo'] ?>"><br>
        DESCRIPTION : <?= $product['description'] ?><br>
        PRIX : <?= $product['prix'] ?><br>
    <?php } ?>

    <?php foreach ($product->getSize() as $stock) { ?>
        NOM : <?= $stock['taille'] ?><br>


    <?php } ?>








</main>

<footer>

</footer>

</body>
</html>
