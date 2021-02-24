<?php

require_once '../class/user.php';
require_once '../class/admin.php';
require_once '../class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$update = new \db\user();
$users = new \db\admin();

$info = $users->setUser();

if (!$users->isAllAdmin()) {
    header('location:../404.php');
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/zoro.css">
    <title>ADMIN</title>
</head>

<body>

<header>
    <?php include("../includes/nav_admin.php"); ?>
</header>

<main class="main_profil">



    <div class="container_form">

        <h1>Modifiez vos données personnelles</h1>

        <form action="admin_profil.php?id=<?= $_SESSION['id'] ?>" method="post">

            <label for="prenom">Prenom</label><br>
            <input type="text" name="prenom" value="<?php echo $info["prenom"] ?>" required><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" value="<?php echo $info["nom"] ?>" required><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" value="<?php echo $info["email"] ?>" required><br>

            <label for="password">Mot de passe</label><br>
            <input type="password" name="password" required><br>

            <label for="confpassword">Confirmer mot de passe</label><br>
            <input type="password" name="confpassword" required><br><br>


            <button type="submit" value="Modifier" name="submit_update">Modifier</button>

            <?php
            if (isset($_POST['submit_update'])) {
                $update->update();

            }
            ?>

        </form>

    </div>

</main>

<footer>
</footer>

</body>
</html>