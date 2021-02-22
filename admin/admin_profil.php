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


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN</title>
</head>

<body>

<header>

    <?php include("../includes/nav_admin.php"); ?>

</header>

<form action="admin_profil.php?id=<?=$_SESSION['id']?>" method="post">

    <label for="prenom">prenom</label> <br/>
    <input type="text" name="prenom" value="<?php echo $info["prenom"] ?>" required><br>

    <label for="nom">nom</label> <br/>
    <input type="text" name="nom" value="<?php echo $info["nom"] ?>" required><br>

    <label for="email">email</label> <br/>
    <input type="text" name="email" value="<?php echo $info["email"] ?>" required><br>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" required><br>

    <label for="confpassword">Confirmer mot de passe</label>
    <input type="password" name="confpassword" required><br>


    <input type="submit" value="Ajouter" name="submit_update">

    <?php
    if(isset($_POST['submit_update'])){
         $update->update();

    }
    ?>


</form>


</body>
</html>