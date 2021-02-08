<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';

session_start();
$product = new \db\product();
$panier = new \db\panier();


?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Boutique</title>
</head>

<body>

<header>
<nav>
    <a href="panier.php">Panier</a>
</nav>
</header>

<main>

    <section>
        <?php foreach ($product->affichages_categories() as $line) { ?>

            <a href="?categorie=<?= $line["categorie"] ?>"><?= $line["categorie"] ?></a>


        <?php } ?>

        <a href='boutique_all.php'>All</a>

    </section>

    <section>
        <?php
        if (isset($_GET['categorie']))

        {
            foreach ($product->affichages_des_produits() as $produits) { ?>

                <div class="boutique-produit">

                    <h2><?=$produits["titre"]?></h2>

                    <a href = detail_produit.php?id_produit=<?= $produits["id_produit"] ?>><img src=../img/<?=$produits["photo"]?> ="500" height="550"></a>

                    <p><?=$produits["prix"] ?> €</p>
                    <p><?=$produits["description"] ?> </p>

                    <a href="detail_produit.php?id_produit=' . <?=$produits["id_produit"] ?>. ' ">Achetez</a>


                </div>

            <?php }

        }
        else
        {
            foreach ($product->affichages_boutique() as $boutique) { ?>

                <div class="boutique-produit">

                    <h2><?=$boutique["titre"]?></h2>

                    <a href = detail_produit.php?id_produit=<?= $boutique["id_produit"] ?>><img src=../img/<?=$boutique["photo"]?> ="500" height="550"></a>

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
