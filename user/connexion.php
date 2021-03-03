<?php

require_once '../class/user.php';
require_once '../class/dataBase.php';

$connect = new \db\user();


?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap"
          rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/zoro.css">
    <link rel="stylesheet" href="../css/user.css">
    <title>Connexion</title>
</head>

<body>

<header>

    <?php
    include '../includes/nav.php';
    ?>

</header>

<main class="main_connexion">

    <article class="connexion_user">

        <h1 class="titre">SE CONNECTER</h1>

        <form action="connexion.php" method="post">

            <input type="email" id="email" name="email" placeholder="Email"><br>

            <input type="password" id="password" name="password" placeholder="Password"><br>


            <button type="submit" name="submit_connect">SE CONNECTER</button>

            <?php
            if (isset($_POST['submit_connect'])) {
                $connect->connect();
            }
            ?>

        </form>



    </article>

    <article class="link_inscription">

        <h1>INSCRIVEZ-VOUS</h1>
        <p>SI VOUS N'AVEZ PAS ENCORE DE COMPTE D'UTILISATEUR DE ZORO.COM, UTILISEZ CETTE OPTION POUR ACCÉDER AU FORMULAIRE D'INSCRIPTION.</p>

        <a href="inscription.php"><button>INSCRIPTION</button></a>

    </article>

</main>

<footer>

    <?php
    include '../includes/footer.php'
    ?>

</footer>

</body>
</html>
