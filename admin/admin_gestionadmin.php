<?php
require_once '../class/product.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';
require_once '../class/user.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$admin = new \db\admin();
$register = new \db\user();

if ($admin->isAdmin()) {


    ?>

    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
              integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
              crossorigin="anonymous">
        <title>Gestion Admin</title>
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
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Email</th>
                <th scope="col">Statut</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($admin->getAdmin() as $admine) { ?>
                <tr>
                    <th><?= $admine['id'] ?></th>
                    <td><?= $admine['nom'] ?></td>
                    <td><?= $admine['prenom'] ?></td>
                    <td><?= $admine['email'] ?></td>
                    <td><?= $admine['admin'] ?></td>
                    <td><a href="admin_deleteUser.php?id=<?= $admine['id'] ?>"><i class="fas fa-trash"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <form action="admin_gestionadmin.php" method="post">

            <label for="prenom">prenom</label> <br/>
            <input type="text" name="prenom" required><br>

            <label for="nom">nom</label> <br/>
            <input type="text" name="nom" required><br>

            <label for="email">email</label> <br/>
            <input type="text" name="email" required><br>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" required><br>

            <label for="confpassword">Confirmer mot de passe</label>
            <input type="password" name="confpassword" required><br>

            <p>Statut:</p>

            <div>
                <input type="radio" name="admin" value="1" >
                <label for="1">Admin Premium</label>
            </div>

            <div>
                <input type="radio" name="admin" value="2" checked>
                <label for="2">Admin</label>
            </div>

            <div>
                <input type="radio" name="admin" value="0" >
                <label for="0">Sans statut (user)</label>
            </div>

            <input type="submit" value="Ajouter" name="submit_addAdmin">

            <?php

            if(isset($_POST['submit_addAdmin'])){
                $admin->addAdmin();

            }
            ?>

        </form>


    </main>

    <footer>

    </footer>

    </body>
    </html>

<?php } else{
    header("location: admin.php");
}?>
