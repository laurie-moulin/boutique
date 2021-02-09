<?php

require_once '../class/product.php';
require_once '../class/dataBase.php';

$product = new \db\product();


//$product->setCategory();
//    $product['categ_product'];

//var_dump($product->setCategory());
var_dump($product->getCategory());

//var_dump($product->getSize());
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


<!--    --><?php //foreach ($product->getSize() as $size => $value) { ?>
<!--    --><?//=  $value['taille'] ?><!--<br>-->
<!--    --><?php //} ?>

    <form action="admin_updateProd.php<?= $product['id_product'] ?>" method="post" enctype="multipart/form-data">

        <label for="date">Date de modification du produit : </label><br>
        <input type="date" id="date" name="date" value='' required><br>

<!--        <label for="categorie-select">Catégorie</label> <br/>-->
<!--        <select name="category"  class="input">-->
<!--            --><?php //foreach ($product->getCategory() as $categorie) { ?>
<!--                <option value="--><?//= $categorie['id'] ?><!--">--><?//= $categorie['categ_product'] ?><!--</option>-->
<!--            --><?php //} ?>
<!--        </select><br>-->



        <label for="nom">Nom</label> <br/>
        <input type="text" id="nom" name="nameProd" value="<?= $product['nom'] ?>" required><br>

        <label for="image">Image</label> <br/>
        <input type="file" id="image" name="image" required><br>

        <label for="description">Description</label> <br/>
        <textarea id="description" name="description"  required> <?= $product['description'] ?></textarea><br>

        <label for="taille">Stock par taille</label> <br/>

        <label for="taille">S</label> <br/>
        <input type="number" id="s" name="S" min="0" required><br>

        <label for="taille">M</label> <br/>
        <input type="number" id="m" name="M" min="0" required><br>

        <label for="taille">L</label> <br/>
        <input type="number" id="l" name="L" min="0" required><br>

        <label for="taille">XL</label> <br/>
        <input type="number" id="xl" name="XL" min="0" required><br>

<!--        --><?php //foreach ($product->getSize() as $size) { ?>
<!--            <label>--><?//= $size['taille'] ?><!--</label>-->
<!--            <input type="number" value="--><?//= $size['stock'] ?><!--" name="--><?//= $size['taille'] ?><!--" class="input">-->
<!--        --><?php //} ?>

        <label for="prix">Prix</label> <br/>
        <input type="number" id="prix" name="prix" value="<?= $product['prix'] ?>" required><br>
        <?php

        ?>

        <input type="submit" value="Ajouter" name="submit_addProd">
    </form>


</main>

<footer>

</footer>

</body>
</html>
