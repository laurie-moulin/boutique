<?php

require_once '../class/user.php';
require_once '../class/admin.php';
require_once '../class/dataBase.php';

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

$update = new \db\user();
$user = new \db\admin();

$info = $user->setUser();


?>



<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>

<body>

<header>

</header>

<main>

    <h1>Bienvenue sur votre profil <?php echo $info["prenom"]?> <?php echo $info["nom"];?></h1>

    <form action="profil.php" method="post" >

        <h1 class="titre">Modifier les données de votre profil</h1>

        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $info["prenom"] ?>" required><br>

        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" value="<?php echo $info["nom"] ?>" required><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $info["email"] ?>" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confpassword">Confirmer mot de passe</label>
        <input type="password" id="confpassword" name="confpassword" required><br>

        <?php

        ?>

        <input type="submit" value="S'inscrire" name="submit_update">
    </form>


</main>

<footer>

</footer>

</body>
</html>