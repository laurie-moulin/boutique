<?php

require_once '../class/product.php';
require_once '../class/dataBase.php';

$product = new \db\product();

$category = $product->setCategory();



?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Admin update</title>
</head>

<body>

<header>

</header>

<main>

    <form action="update.php?id=<?= $category['id'] ?>" method="post">

            <label for="categoryUpdate">Modifier nom Catégorie</label>
            <input type="text" name="categoryUpdate"  value="<?= $category['categ_product'] ?>"
                   class="input">
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
