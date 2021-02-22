<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

include ("../includes/nav_admin.php");

$product = new \db\product();
$category = $product->setCategory();


?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Admin delete</title>
</head>

<body>

<header>

</header>

<main>

    <form action="admin_deleteCat.php?id=<?= $category['id'] ?>" method="post">
        <p>Etes-vous sure de vouloir supprimer la catégorie : <?php echo $category['categ_product'] ?> ? </p>

        <?php if (isset($_POST['submit_delete'])) {
            $delete = $product->deleteCategory();
            header("location: admin_category.php");
        }

        ?>

        <button type="submit" name="submit_delete">Supprimer <i class="fas fa-check"></i></button>
    </form>


</main>

<footer>

</footer>

</body>
</html>
