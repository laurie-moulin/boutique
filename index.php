<?php
require_once 'class/user.php';
require_once 'class/dataBase.php';
require_once 'class/commands.php';
require_once 'class/newsletter.php';


if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$user = new \db\user();
$commands = new \db\Commands();




?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/logovignette-100.jpg" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/zoro.css">
    <link rel="stylesheet" href="css/shop.css" />
    <title>Accueil</title>
</head>

<body>

<header>

    <?php include 'nav.php' ?>

</header>

<main>

    <video autoplay loop class="video">
        <source src="img/index/video.mp4"
                type="video/mp4">
        Sorry, your browser doesn't support embedded videos.
    </video>

    <div class="txt_defilant">
        <div> NOUVEAUTÉS POUR HOMMES -
            RÉINVENTE TON LOOK AVEC LES DERNIERS VÊTEMENTS ET ACCESSOIRES TENDANCE POUR HOMME. DÉCOUVRE DES NOUVEAUTÉS
            CHAQUE SEMAINE.
        </div>
    </div>


    <h4>ZORO - La mode pour tout les hommes.</h4>


    <div class="container_img">

        <img src="img/men2.PNG" class="main_img">
        <img src="img/men.PNG" class="main_img">
    </div>

    <div class="container_info">

        <div class="info">
            <i class="fas fa-truck"></i>
            <p>Livraison offerte à domicile <br>et en magasin</p>
        </div>

        <div class="info">
            <i class="fas fa-undo"></i>
            <p>30 jours pour changer d'avis</p>
        </div>

        <div class="info">
            <div class="card">
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <p>Paiement 100% sécurisé</p>
        </div>

    </div>

    <h1 class="nouveaute">NOUVEAUTÉS</h1>
    <section class="picture_categoryNews">
        <?php
        foreach ($commands->nouveaute() as $new) { ?>
            <div class="flex_product5">
                <span class="new_article">NEW</span>
                <a href = pages/detail_produit.php?id_product=<?= $new["id_product"] ?>><img src=img/imgboutique/<?=$new["photo"]?> ="500" height="400"></a>
                <span class="text_decriptionnews"><?=strtoupper($new["nom"]) ?></span<br><br>
                <?="<span class='text_police' >".$new["prix"] ." EUR</span>"?>
            </div>
        <?php }?>
    </section>

    <article class="container_newsletter">

        <h1>ABONNEZ-VOUS A NOTRE NEWSLETTER</h1>

        <form action="index.php" method="post">

            <input type="text" name="fname" placeholder="Prénom"/><br>
            <input type="text" name="lname" placeholder="Nom"/><br>
            <input type="email" name="email" placeholder="Email"><br>

            <?php

            if (isset($_POST['submit_news'])) {
                $newsletter = new \db\newsletter();
                $newsletter->addNewsletter();
            }

            ?>

            <button type="submit" name="submit_news">S'inscrire</button>
        </form>

    </article>

</main>

<footer>

    <?php
    include 'footer.php';
    ?>
</footer>

</body>

</html>