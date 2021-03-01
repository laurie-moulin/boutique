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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/shop.css" />
    <link rel="stylesheet" href="../css/zoro.css" />
    <title>Commande</title>
</head>
<body>
<header>
    <?php
    include '../includes/nav.php';
    ?>
</header>
<main class="main_recapCommande">
    <article>
        <p class="nav_adresse"><span class="span_livraison">RESUMÉ </span> > TOUTES MES COMMANDES</p>
        <section class="all_delivery">
            <section>
                <article class="delivery_title">
                    <img src="../img/order.png">
                    <h1>RECAPITULATIF DE TOUTES MES COMMANDES ET DETAILS</h1>

                </article>
            </section>
        <?php

        if(isset($_SESSION["id"]))
        {
            foreach($product->get_profil_commande() as $keys => $values)
            {
                ?>
                <div class="bask_commande">
                    <?= strtoupper($values["nom"] ) ?><br>
                    <?=   $values["prenom"]." "?><br>
                    <?=   $values["email"] ?><br>
                    <?=  strtoupper($values["adresse"]) ." ||"?>
                    <?=  strtoupper($values["code_postal"]) ." ||"?>
                    <?=  strtoupper($values["ville"]) ?><br>
                    <?=  strtoupper($values["telephone"])?><br>
                </div>
                <?php
            }
            ?>
            <?php
            if(isset($_GET["id_commande"]))
            {
            echo "<h1 class='h1_tite_commande'>COMMANDE N°". $_GET["id_commande"]."</h1>";
            ?>
            <?php
            foreach($product->detail_Commande($_GET["id_commande"]) as $keys => $values)
            {
            ?>
            <div class="bask_detail_commande">

                <?=  "ID_PRODUIT: ".$values["id_product"] ?><br>
                <?=  "QUANTITÉ : " .$values["quantité"]?><br>
                <?=  "TAILLE : ".strtoupper($values["taille"]) ?><br>
                <?=  "PRIX A L'UNITÉ : ". $values["prix_produit"] . " EUR"?><br>
                <hr class="hr_title">
            <?php
            }
            ?>
                <div class="flex_refresh_commande">
                <?=   "DATE : ".date('d/m/Y', strtotime($values["date_enregistrement"])) ?><br>
                <?=  "PRIX TOTAL : ". $values["montant"] . " EUR"?>
                <a class="refresh_commande" href="voir_commande.php">REFRESH</a>
                </div>
                </div>

            <?php
            } ?>

            <h1 class="h1_commande">VOS DERNIÈRES COMMANDES</h1>
            <?php
            foreach($product->getCommande() as $keys => $values)
            {
                ?>
                <div class="flex_commande">
                <?= "<span class='bold_commande'>COMMANDE N°  :   </span>" ."". strtoupper($values["id_commande"] ) ?>
                    <?=   "<span class='bold_commande'> DATE : </span>" .date('d/m/Y', strtotime($values["date_enregistrement"])) ?>
                    <?=  " <span class='bold_commande'> PRIX TOTAL : </span>" . $values["montant"]." EUR" ."   "?>
                     <p class="order_end">COMMANDE TERMINÉE</p>
                    <a href="voir_commande.php?id_commande=<?= $values['id_commande'] ?>">VOIR DETAIL</a><br>

                </div>
                <hr class="hr_commande">
                <?php
            }?>

            <?php

        }
        else
        {
            header('location:../404.php');
        }
        ?>
    </article>

</main>
<footer></footer>
</body>
</html>

