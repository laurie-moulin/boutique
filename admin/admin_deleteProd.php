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
//
//$products = $product->setProduct();




//$category = $product->setCategory();


?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <title>DELETE product</title>
</head>

<body>

<header>

</header>

<main>

    <?php foreach ($product->setProduct() as $products) { ?>

    <?php } ?>


    <form action="admin_deleteProd.php?id=<?= $products['id_product'] ?>" method="post" class="form_delete">
        <p>Etes-vous sure de vouloir supprimer le produit: <?php echo $products['nom'] ?> ? </p>

        <?php if (isset($_POST['submit_delete'])) {
            $delete = $product->deleteProduct();
            header("location: admin_product.php");
        }

        ?>

        <button type="submit" name="submit_delete">Supprimer <i class="fas fa-check"></i></button>
    </form>


</main>

<footer>

</footer>

</body>
</html>
