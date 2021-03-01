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



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <title>Boutique</title>
    <link rel="stylesheet" href="../css/shop.css" />
</head>

<body>
<header>
<nav>
    <a class="basket" href="panier.php">Panier</a>
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
    <section class="text_category">
        <?php foreach ($product->affichages_categories() as $line) { ?>
          <a href="?id_category=<?= $line["id"] ?>"><?= strtoupper($line['categ_product'] )?></a>
        <?php } ?>

        <a href='boutique_all.php'>ALL</a>

    </section>

    <section class="picture_category">
        <?php
        if (isset($_GET['id_category']))
        {
            foreach ($product->affichages_des_produits() as $produits) { ?>
                <div class="flex_product">
                    <a href = detail_produit.php?id_product=<?= $produits["id_product"] ?>><img src=../img/<?=$produits["photo"]?> ="500" height="550"></a>
                   <?=strtoupper($produits["description"]) ?><br>
                    <span class="text_police"><?=number_format($produits["prix"] ,2,',',' ') . " EUR"?></span>
                </div>
            <?php }
            if (empty($_GET['id_category']))
            {
                echo "La catégorie selectionée est en rupture de stock !";
            }
        }
        else
        {
            foreach ($product->affichages_boutique() as $boutique) { ?>
                <div class="flex_product">

                    <a href = detail_produit.php?id_product=<?= $boutique["id_product"] ?>><img src=../img/<?=$boutique["photo"]?> ="500" height="550"></a>
                    <?=strtoupper($boutique["description"]) ?> <br>
                   <span class="text_police"><?=number_format($boutique["prix"] ,2,',',' '). " EUR"?></span>

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
