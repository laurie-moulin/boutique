<?php

require_once '../class/product.php';
require_once '../class/dataBase.php';

$product = new \db\product();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Admin Product</title>
</head>

<body>

<header>

</header>

<main>

    <a href="admin_addProd.php">Ajouter un produit</a>


    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#id</th>
            <th scope="col">Nom catégorie</th>
            <th scope="col">Supprimer</th>
            <th scope="col">Modifier</th>
        </tr>
        </thead>
        <tbody>


        </tbody>
    </table>


</main>

<footer>

</footer>

</body>
</html>
