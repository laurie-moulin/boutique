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
    <link rel="stylesheet" href="../css/zoro.css">
    <link rel="stylesheet" href="../css/user.css">
    <title>Inscription</title>
</head>

<body>

<header>

    <?php
    include 'nav.php';
    ?>

</header>

<main class="main_inscription">

    <article class="form_inscription">

        <h1 class="titre">INSCRIPTION</h1>

    <form action="inscription.php" method="post" >

        <input type="text" id="prenom" name="prenom" placeholder="Prénom" required><br>

        <input type="text" id="nom" name="nom" placeholder="Nom" required><br>

        <input type="email" id="email" name="email" placeholder="Email" required><br>

        <input type="password" id="password" name="password" placeholder="Password" required><br>

        <input type="password" id="confpassword" name="confpassword" placeholder="Confirmation password" required><br>

        <?php
        if(isset($_POST['submit_register'])){
            $register->register();
        }
        ?>

        <button type="submit" value="S'inscrire" name="submit_register">S'inscrire</button>
    </form>
    </article>
</main>

<footer>

    <?php
    include '../includes/footer.php'
    ?>

</footer>

</body>
</html>
