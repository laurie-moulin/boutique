<?php

require_once '../class/product.php';
require_once '../class/dataBase.php';

$product = new \db\product();

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
$today = date('Y-m-m');


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
    <form action="admin_addProd.php" method="post">

        <label for="date">Date d'ajout du produit : </label><br>
        <input type="date" id="date" name="date" value=<?php echo $today ?> min=<?php echo $today ?> max=<?php echo $today ?>><br>

        <label for="categorie-select">Catégorie</label> <br/>
        <select name="categorie" id="categorie-select" class="input">
            <?php foreach ($product->getCategory() as $categorie) { ?>
                <option value="<?= $categorie['id'] ?>"><?= $categorie['categ_product'] ?></option>
            <?php } ?>
        </select><br>

        <label for="nom">Nom</label> <br/>
        <input type="text" id="nom" name="nom_produit" required><br>

        <label for="image">Image</label> <br/>
        <input type="file" id="image" name="image" required><br>

        <label for="description">Description</label> <br/>
        <textarea id="description" name="description" required> </textarea><br>

        <label for="taille">Stock par taille</label> <br/>

        <label for="taille">S</label> <br/>
        <input type="number" id="s" name="s" min="0" required><br>

        <label for="taille">M</label> <br/>
        <input type="number" id="m" name="m" min="0" required><br>

        <label for="taille">L</label> <br/>
        <input type="number" id="l" name="l" min="0" required><br>

        <label for="taille">XL</label> <br/>
        <input type="number" id="xl" name="xl" min="0" required><br>


        <label for="prix">Prix</label> <br/>
        <input type="number" id="prix" name="prix" min="0" step="0.01" required><br>

        <label for="promo">Prix Promotion</label> <br/>
        <input type="number" id="promo" name="promo" min="0" step="0.01">

        <input type="hidden" value="addproduct" name="type" class="input">
        <button type="submit">Envoyer</button>
    </form>


</main>

<footer>

</footer>

</body>
</html>
