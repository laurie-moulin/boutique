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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/zoro.css">
    <link rel="stylesheet" href="../css/user.css">
    <title>Profil</title>
</head>

<body>

<header>

    <?php
    include '../includes/nav.php';
    ?>

</header>

<main class="main_profil">

    <article class="bigcontainer">

        <div class="container_profilform">

            <h1>Bienvenue sur votre profil <?php echo $info["prenom"] ?> <?php echo $info["nom"]; ?></h1>

            <form action="profil.php?id=<?= $_SESSION['id'] ?>" method="post" class="form_profil">

                <h2 class="titre">Modifier les données de votre profil</h2>

                <label for="prenom">Prénom</label><br>
                <input type="text" id="prenom" name="prenom" value="<?php echo $info["prenom"] ?>" required><br>

                <label for="nom">Nom</label><br>
                <input type="text" id="nom" name="nom" value="<?php echo $info["nom"] ?>" required><br>

                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="<?php echo $info["email"] ?>" required><br>

                <label for="password">Mot de passe</label><br>
                <input type="password" id="password" name="password" required><br>

                <label for="confpassword">Confirmer mot de passe</label><br>
                <input type="password" id="confpassword" name="confpassword" required><br>


                <button class="button_profil" type="submit" value="Modifier" name="submit_update">Modifier</button>

                <?php

                if (isset($_POST['submit_update'])) {
                    $update->update();

                }

                ?>
            </form>
        </div>

        <div class="container_infoprofil">

            <div class="button_commande"><a href="#">Historique des commandes <i class="fas fa-shopping-cart"></i></a></div>

            <div class="newsletter">
                <h1>ABONNEZ-VOUS A NOTRE NEWSLETTER</h1>

                <form action="profil.php?id=<?= $_SESSION['id'] ?>" method="post">

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $info["email"] ?>" ><br><br>

                                    <?php

                                    if(isset($_POST['submit_news']))
                                    {
                                        $news = $update->newsletter();
                                    }

                                    ?>

                    <button type="submit" name="submit_news">S'inscrire</button>
                </form>
            </div>

        </div>

    </article>

</main>

<footer>

    <?php
    include '../includes/footer.php';
    ?>

</footer>

</body>
</html>