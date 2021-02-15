<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$admin = new \db\admin();


if ($admin->isAdmin()) {


    $users = $admin->setUser();


    ?>

    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
              integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
              crossorigin="anonymous">
        <title>Delete User</title>
    </head>

    <body>

    <header>

        <?php include("../includes/nav_admin.php"); ?>

    </header>

    <main>
        <form action="admin_deleteUser.php?id=<?=$users['id']?>" method="post">
            <p>Etes-vous sure de vouloir supprimer cet utilisateur : <?php echo $users['prenom'] ?> ? </p>
            prout

            <?php if (isset($_POST['submit_delete'])) {
                $delete = $admin->deleteUser();
                header("location: admin_gestionusers.php");
            }
            ?>

            <button type="submit" name="submit_delete">Supprimer <i class="fas fa-check"></i></button>
        </form>


    </main>

    <footer>

    </footer>

    </body>
    </html>

<?php } else {
    header("location: admin.php");
} ?>
