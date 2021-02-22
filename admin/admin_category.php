<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

include ("../includes/nav_admin.php");

$product = new \db\product();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Admin</title>
</head>

<body>

<header>

</header>

<main>

    <form action="admin_category.php" method="post" class="form_categ">
        <label for="name">Ajouter une catégorie: </label>
        <input type="text" name="add_categ" required>

        <input type="submit" value="submit" name="submit">

        <?php if (isset($_POST['submit'])) {
        $product->addCategory();
        }

        ?>
    </form>

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


</main>

<footer>

</footer>

</body>
</html>
