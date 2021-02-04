<?php

require_once '../class/product.php';
require_once '../class/dataBase.php';

$product = new \db\product();

if(isset($_POST['submit'])){
    $product->addCategory();
}


?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>

<header>

</header>

<main>

    <form action="admin.php" method="post" class="form_categ">

        <label for="name">Ajouter une catégorie:  </label>
        <input type="text" name="add_categ"  required>

        <input type="submit" value="submit" name="submit">


    </form>

</main>

<footer>

</footer>

</body>
</html>
