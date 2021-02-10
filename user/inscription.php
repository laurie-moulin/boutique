<?php

require_once '../class/user.php';
require_once '../class/dataBase.php';

$register = new \db\user();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Inscription</title>
</head>

<body>

<header>

</header>

<main>

    <form action="inscription.php" method="post" >

        <h1 class="titre">INSCRIPTION</h1>

        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confpassword">Confirmer mot de passe</label>
        <input type="password" id="confpassword" name="confpassword" required><br>

        <?php
        if(isset($_POST['submit_register'])){
            $register->register();
        }
        ?>

        <input type="submit" value="S'inscrire" name="submit_register">
    </form>

</main>

<footer>

</footer>

</body>
</html>
