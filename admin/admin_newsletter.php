<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$admin = new \db\admin();

if (!$admin->isAllAdmin()) {
    header('location:../404.php');
}


if ($admin->isAdmin()) {


    ?>

    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
              integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/zoro.css">
        <title>Gestion Users</title>
    </head>

    <body>

    <header>

        <?php include("../includes/nav_admin.php"); ?>

    </header>

    <main class="main_newsletter">

        <a href="https://login.mailchimp.com/?_ga=2.61454060.1593604843.1614671456-1484478570.1613981049"><img src="../img/mailchimp.gif" height="250"></a>

    </main>

    <footer>

    </footer>

    </body>
    </html>

<?php } else{
    header("location: admin.php");
}?>
