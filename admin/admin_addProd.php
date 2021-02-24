<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$admin = new \db\admin();
if (!$admin->isAllAdmin()) {
    header('location:../404.php');
}



$product = new \db\product();

$error = '';
date_default_timezone_set('Europe/Paris');
$today = date("d/m/Y");

if (isset($_POST['submit_addProd'])) {
    $product->addProduct();
}






?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Add Product</title>
</head>

<body>

<header>

    <?php
    include '../includes/nav_admin.php';
    ?>

</header>

<main class="main_addProd">

    <h4>Ajout de produits</h4>

    <div class="container_form_Addprod">

        <div class="div1">

            <form action="admin_addProd.php" method="post" enctype="multipart/form-data">

                <label for="date">Date d'ajout du produit : </label><br>
                <input type="date" id="date" name="date" value='<?php echo $today ?>' required><br>

                <label for="ref">Référence du produit: </label><br>
                <input type="text" id="ref" name="ref" required><br>

                <label for="categorie-select">Catégorie</label> <br/>
                <select name="category" class="input">
                    <option></option>
                    <?php foreach ($product->getCategory() as $categorie) { ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['categ_product'] ?></option>
                    <?php } ?>
                </select><br>

                <label for="nom">Nom</label> <br/>
                <input type="text" id="nom" name="nameProd" required><br>

                <label for="image">Image</label> <br/>
                <input type="file" class="file" name="image" required><br>

                <label for="description">Description</label> <br/>
                <textarea id="description" name="description" rows="5" cols="40" required> </textarea><br>

        </div>

        <div class="div2">


            <label for="taille">Stock par taille</label> <br/><br>

            <label for="taille">S</label> <br/>
            <input type="number" id="s" name="S" min="0" required><br>

            <label for="taille">M</label> <br/>
            <input type="number" id="m" name="M" min="0" required><br>

            <label for="taille">L</label> <br/>
            <input type="number" id="l" name="L" min="0" required><br>

            <label for="taille">XL</label> <br/>
            <input type="number" id="xl" name="XL" min="0" required><br>


            <label for="prix">Prix</label> <br/>
            <input type="number" id="prix" name="prix" min="0" step="0.01" required><br>
            <?php

            ?>

            <button type="submit" value="Ajouter" name="submit_addProd">Ajouter</button>
            </form>

        </div>
    </div>

</main>

<footer>

</footer>

</body>
</html>
