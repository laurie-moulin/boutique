<?php

require_once '../class/admin.php';
require_once '../class/dataBase.php';

$connectAdmin = new \db\admin();


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>

<body>

<header>
    <div class="beginNav">
        <div><a href="../index.php"><img src="../img/index/logo.png" width="10%"></a></div>
        <div><h1>Espace Administrateur</h1></div>
    </div>
</header>

<main>

    <article class="connexion_admin">

        <h1 class="titre">CONNEXION ADMINISTRATEUR</h1>

        <form action="connexion_admin.php" method="post">

            <input type="email" id="email" name="email" placeholder="Email"><br>

            <input type="password" id="password" name="password" placeholder="Password"><br>

            <?php
            if (isset($_POST['submit_connect'])) {
                $connectAdmin->connectAdmin();
            }
            ?>

            <button type="submit" name="submit_connect">SE CONNECTER</button>
        </form>
</main>

</article>

</body>
</html>