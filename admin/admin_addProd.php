<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

include ("../includes/nav_admin.php");

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
    <title>Admin Add Product</title>
</head>

<body>

<header>

</header>

<main>
    <form action="admin_addProd.php" method="post" enctype="multipart/form-data">

        <label for="date">Date d'ajout du produit : </label><br>
        <input type="date" id="date" name="date" value='<?php echo $today ?>' required><br>

        <label for="categorie-select">Catégorie</label> <br/>
        <select name="category"  class="input">
            <?php foreach ($product->getCategory() as $categorie) { ?>
                <option value="<?= $categorie['id'] ?>"><?= $categorie['categ_product'] ?></option>
            <?php } ?>
        </select><br>

        <label for="nom">Nom</label> <br/>
        <input type="text" id="nom" name="nameProd" required><br>

        <label for="image">Image</label> <br/>
        <input type="file" id="image" name="image" required><br>

        <label for="description">Description</label> <br/>
        <textarea id="description" name="description" required> </textarea><br>


        <label for="taille">Stock par taille</label> <br/>

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

        <input type="submit" value="Ajouter" name="submit_addProd">
    </form>


</main>

<footer>

</footer>

</body>
</html>
