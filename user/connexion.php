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
    <title>Connexion</title>
</head>

<body>

<header>

</header>

<main>

    <form action="connexion.php" method="post" >

        <h1 class="titre">Connexion</h1>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required><br>


<!--        --><?php
//        if(isset($_POST['submit_register'])){
//            $register->register();
//        }
//        ?>

        <input type="submit" value="Se connecter" name="submit_connect">
    </form>

</main>

<footer>

</footer>

</body>
</html>
