<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/user.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

include("../includes/nav_admin.php");

$product = new \db\product();

//var_dump($product->setCategory());
//var_dump($_GET['id']);
//var_dump($product->getCategProd());

//$category = $product->getCategory();
//var_dump($category);

//$stock = $product->getSize();

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


    <?php foreach ($product->setProduct() as $products) { ?>
        NOM : <?= $products['nom'] ?><br>
        ID : <?= $products['id_product'] ?><br>
        DESCRIPTION : <?= $products['description'] ?><br>
        PRIX : <?= $products['prix'] ?><br>
        <img width="300px" src="../img/imgboutique/<?= $products['photo'] ?>"><br>
    <?php } ?>

    <!--    --><?php //foreach ($product->getAllProducts() as $categ) { ?>
    <!--      CATEGORIE : --><? //= $categ['categ_product'] ?>
    <!--        -->
    <!--    --><?php //} ?>


    <form action="admin_updateProd.php?id=<?= $products['id_product'] ?>" method="post" enctype="multipart/form-data">

        <label for="date">Date de modification du produit : </label><br>
        <input type="date" id="date" name="date" value='' required><br>

        <label for="categorie-select">Catégorie</label> <br/>
        <select name="category" class="input" required>
            <option value=""></option>
            <?php foreach ($product->getCategory() as $category) { ?>
                <option value="<?= $category['id'] ?>"><?= $category['categ_product'] ?></option>
            <?php } ?>
        </select><br>


        <label for="nom">Nom</label> <br/>
        <input type="text" id="nom" name="nom" value="<?= $products['nom'] ?>"><br>

        <label for="image">Image</label> <br/>
        <input type="file" id="image" name="image"><br>

        <label for="description">Description</label> <br/>
        <textarea id="description" name="description"> <?= $products['description'] ?></textarea><br>

        <table>
            <tr>
                <th>Taille</th>
                <th>Stock actuel</th
            </tr>
            <?php foreach ($product->getSizes() as $sizes) { ?>

                <tr>
                    <td><?php echo $sizes['taille'] ?></td>
                    <td><?php echo $sizes['stock'] ?></td>

                </tr>
            <?php } ?>
        </table>

        <p>Nouveau stock</p>

        <?php foreach ($product->getSizes() as $sizes) { ?>

            <label><?= strtoupper($sizes['taille']) ?></label>
            <input type="number" value="<?= $sizes['stock'] ?>" name="<?= $sizes['taille'] ?>" class="input"><br><br>
        <?php } ?>


        <label for="prix">Prix</label> <br/>
        <input type="number" id="prix" name="prix" value="<?= $products['prix'] ?>"><br><br>


        <input type="submit" value="Modifier" name="submit_updateProd">

        <?php

        if (isset($_POST['submit_updateProd'])) {
            $product->updateProduct();
        }

        ?>

    </form>


</main>

<footer>

</footer>

</body>
</html>
