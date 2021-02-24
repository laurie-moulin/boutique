<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/user.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

include("../includes/nav_admin.php");

$product = new \db\product();

$admin = new \db\admin();
if (!$admin->isAllAdmin()) {
    header('location:../404.php');
}



?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin update</title>
</head>

<body>

<header>

</header>

<main class="update_product">

    <h4>Information du produit</h4>

    <div class="container_infoproduct">

        <div>

            <?php foreach ($product->setProduct() as $picture) { ?>
                <img width="300px" src="../img/imgboutique/<?= $picture['photo'] ?>"><br>
            <?php } ?>

        </div>

        <div class="container_allInfo">

            <?php foreach ($product->setProduct() as $products) { ?>
                <p>NOM : <?= $products['nom'] ?><br>
                    REFERENCE : <?= $products['ref'] ?><br>
                    DESCRIPTION : <?= $products['description'] ?><br>
                    PRIX : <?= $products['prix'] ?> €</p><br>
            <?php } ?>

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

            <!--    --><?php //foreach ($product->getAllProducts() as $categ) { ?>
            <!--      CATEGORIE : --><? //= $categ['categ_product'] ?>
            <!--        -->
            <!--    --><?php //} ?>

        </div>

    </div>

    <h4>Modification du produit</h4>
    <div class="container_form_Addprod">



        <div class="div1">


            <form action="admin_updateProd.php?id=<?= $products['id_product'] ?>" method="post"
                  enctype="multipart/form-data">

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
                <textarea id="description" name="description " rows="5"
                          cols="40"> <?= $products['description'] ?></textarea><br>

        </div>

        <div class="div2">

            <p>Nouveau stock</p>

            <?php foreach ($product->getSizes() as $sizes) { ?>

                <label><?= strtoupper($sizes['taille']) ?></label>
                <input type="number" value="<?= $sizes['stock'] ?>" name="<?= $sizes['taille'] ?>" class="input">
                <br><br>
            <?php } ?>


            <label for="prix">Prix</label> <br/>
            <input type="number" id="prix" name="prix" value="<?= $products['prix'] ?>"><br><br>


            <button type="submit" value="Modifier" name="submit_updateProd">Modifier</button>

            <?php

            if (isset($_POST['submit_updateProd'])) {
                $product->updateProduct();
            }

            ?>

            </form>

        </div>
    </div>
</main>

<footer>

</footer>

</body>

</html>
