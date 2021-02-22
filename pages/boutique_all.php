<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/commands.php';
require_once '../class/admin.php';
require_once '../class/user.php';
require_once '../class/admin.php';


$product = new \db\product();
$panier = new \db\panier();
$commands = new \db\Commands();
$admin = new \db\admin();
$user = new \db\admin();

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

var_dump( $_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Boutique</title>
    <link rel="stylesheet" href="../css/shop.css" />
</head>

<body>
<header>
<nav>
    <a href="panier.php">Panier</a>
</nav>
</header>

<main>
    <article>
    <?php
/*    if(isset($_SESSION["icon_shop"]))
    {
        echo "<div class='test'>";
        echo  $_SESSION["icon_shop"] ;
        echo "</div>";
    }*/
    ?>
    </article>
    <section>
        <?php foreach ($product->affichages_categories() as $line) { ?>
          <a href="?id_category=<?= $line["id"] ?>"><?= $line['categ_product'] ?></a>
        <?php } ?>

        <a href='boutique_all.php'>All</a>

    </section>

    <section>
        <?php
        if (isset($_GET['id_category']))
        {
            foreach ($product->affichages_des_produits() as $produits) { ?>
                <div>
                    <h2><?=$produits["nom"]?></h2>
                    <a href = detail_produit.php?id_product=<?= $produits["id_product"] ?>><img src=../img/<?=$produits["photo"]?> ="500" height="550"></a>
                    <p><?=$produits["prix"] ?> €</p>
                    <p><?=$produits["description"] ?> </p>
                </div>
            <?php }
        }
        else
        {
            foreach ($product->affichages_boutique() as $boutique) { ?>
                <div>
                    <h2><?=$boutique["nom"]?></h2>
                    <a href = detail_produit.php?id_product=<?= $boutique["id_product"] ?>><img src=../img/<?=$boutique["photo"]?> ="500" height="550"></a>
                    <p><?=number_format($boutique["prix"] ,2,',',' ')?> €</p>
                    <p><?=$boutique["description"] ?> </p>
                </div>
            <?php }
        }
        ?>
    </section>
</main>

<footer>
</footer>

</body>
</html>
