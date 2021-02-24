<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$admin = new \db\admin();

if (!$admin->isAdmin()) {
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

    <main class="main_users">



        <div class="container_tableusers">
            <h4>Gestion des utilisateurs</h4>
            <table>
                <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Statut</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($admin->getUsers() as $user) { ?>
                    <tr>
                        <th><?= $user['id'] ?></th>
                        <td><?= $user['nom'] ?></td>
                        <td><?= $user['prenom'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['admin'] ?></td>
                        <td><a href="admin_deleteUser.php?id=<?= $user['id'] ?>"><i class="fas fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>

    </main>

    <footer>

    </footer>

    </body>
    </html>

<?php } else {
    header("location: admin.php");
} ?>
