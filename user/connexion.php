<?php

require_once '../class/user.php';
require_once '../class/dataBase.php';

$connect = new \db\user();


?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    include 'nav.php';
    ?>

</header>

<main>

    <article class="connexion_user">

        <h1 class="titre">SE CONNECTER</h1>

        <form action="connexion.php" method="post">

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email"><br>

            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password"><br>


            <?php
            if (isset($_POST['submit_connect'])) {
                $connect->connect();
            }
            ?>

            <input type="submit" value="Se connecter" name="submit_connect">
        </form>

    </article>

</main>

<footer>

    <?php
//    include '../includes/footer.php'
    ?>

</footer>

</body>
</html>
