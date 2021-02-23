<?php
require_once 'class/user.php';
require_once 'class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$user = new \db\user();



?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/zoro.css">
    <title>Accueil</title>
</head>

<body>

<header>

    <?php include 'includes/nav.php'?>

</header>

<main>

    <video autoplay loop class="video">
        <source src="img/index/video.mp4"
                type="video/mp4">
        Sorry, your browser doesn't support embedded videos.
    </video>

    <div class="txt_defilant">
        <div> NOUVEAUTÉS POUR HOMMES -
            RÉINVENTE TON LOOK AVEC LES DERNIERS VÊTEMENTS ET ACCESSOIRES TENDANCE POUR HOMME. DÉCOUVRE DES NOUVEAUTÉS CHAQUE SEMAINE. </div>
    </div>

<!--    <img src="img/zoro1.PNG" class="img_principal">-->

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

<article class="container_newsletter">

    <h1>ABONNEZ-VOUS A NOTRE NEWSLETTER</h1>

    <form action="index.php" method="post">

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <?php

        if(isset($_POST['submit_news']))
        {
            $news = $user->newsletter();
        }

        ?>

        <button type="submit" name="submit_news">S'inscrire</button>
    </form>

</article>



</main>

<footer>

</footer>

</body>

</html>