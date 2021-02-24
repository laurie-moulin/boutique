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

include ("../includes/nav_admin.php");

$product = new \db\product();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin</title>
</head>

<body>

<header>

</header>

<main>

    <form action="admin_category.php" method="post" class="form_categ">
        <label for="name">Ajouter une catégorie: </label>
        <input type="text" name="add_categ" required>

        <button type="submit" value="submit" name="submit">Ajouter</button>

        <?php if (isset($_POST['submit'])) {
        $product->addCategory();
        }

        ?>
    </form>

    <div class="container_tablecateg">

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
        <?php foreach ($product->getCategory() as $category) { ?>
            <tr>
                <th><?= $category['id'] ?></th>
                <td><?= $category['categ_product'] ?></td>
                <td><a href="admin_deleteCat.php?id=<?= $category['id'] ?>"><i class="fas fa-trash"></i></a></td>
                <td><a href="admin_updateCat.php?id=<?= $category['id'] ?>"><i class="fas fa-pencil-alt"></i></a></td>
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
