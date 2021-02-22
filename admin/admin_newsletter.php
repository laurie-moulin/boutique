<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$admin = new \db\admin();


if ($admin->isAdmin()) {


    ?>

    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
              integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
              crossorigin="anonymous">
        <title>Gestion Users</title>
    </head>

    <body>

    <header>

        <?php include("../includes/nav_admin.php"); ?>

    </header>

    <main>

        <table>
            <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($admin->getNews() as $news) { ?>
                <tr>
                    <th><?= $news['id_news'] ?></th>
                    <td><?= $news['email_news'] ?></td>
<!--                    <td><a href="admin_deleteUser.php?id=--><?//= $user['id'] ?><!--"><i class="fas fa-trash"></i></a></td>-->
                </tr>
            <?php } ?>
            </tbody>
        </table>



    </main>

    <footer>

    </footer>

    </body>
    </html>

<?php } else{
    header("location: admin.php");
}?>