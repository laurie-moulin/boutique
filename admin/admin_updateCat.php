<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$product = new \db\product();

$admin = new \db\admin();
if (!$admin->isAllAdmin()) {
    header('location:../404.php');
}

$category = $product->setCategory();

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

    <?php
    include '../includes/nav_admin.php';
    ?>
</header>

<main>

    <form action="admin_updateCat.php?id=<?= $category['id'] ?>" method="post" class="update_categ">

            <label for="categoryUpdate">Modifier nom Catégorie</label>
            <input type="text" name="categoryUpdate"  value="<?= $category['categ_product'] ?>"
                   class="input"><br><br>
        <?php if (isset($_POST['submit_update'])) {
            $product->updateCategory();
        }

        ?>

        <button type="submit" name="submit_update">Modifier <i class="fas fa-check"></i></button>
    </form>



</main>

<footer>

</footer>

</body>
</html>
