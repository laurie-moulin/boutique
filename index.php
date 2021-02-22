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
    <title>Accueil</title>
</head>

<body>

<header>

</header>

<main>

    <h1>S'inscrire à la newsletter</h1>

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



</main>

<footer>

</footer>

</body>

</html>