<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}


$product = new \db\product();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/zoro.css">
    <title>Admin Product</title>
</head>

<body>

<header>

    <?php
   include("../includes/nav_admin.php");
    ?>
</header>

<main class="main_product">

    <h4>Gestion des produits</h4>

    <div class="container_tableproduct">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Référence</th>
                <th scope="col">Image</th>
                <th scope="col">Supprimer</th>
                <th scope="col">Modifier</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($product->getAllProducts() as $product) { ?>
                <tr>
                    <th><?= $product['id_product'] ?></th>
                    <td><?= $product['categ_product'] ?></td>
                    <td><?= $product['nom'] ?></td>
                    <td><?= $product['prix'] ?> €</td>
                    <td><?= $product['ref'] ?></td>
                    <td><img width="70px" src="../img/imgboutique/<?= $product['photo'] ?>"></td>
                    <td><a href="admin_deleteProd.php?id=<?= $product['id_product'] ?>"><i class="fas fa-trash"></i></a>
                    </td>
                    <td><a href="admin_updateProd.php?id=<?= $product['id_product'] ?>"><i
                                    class="fas fa-pencil-alt"></i></a></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </div>

</main>

<footer>

</footer>

</body>
</html>
