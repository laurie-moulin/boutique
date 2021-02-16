<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';
require_once '../class/newletters.Class.php';

session_start();

$product = new \db\Product();
$panier = new \db\Panier();
$search = new \db\Search();
$newletters = new \db\newletter();

?>

<?php

if (isset($_POST['submit']) and isset($_POST["email"])) {
    $email =htmlspecialchars($_POST["email"]);
    $newletters->newsletter($email );
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Utilisation de main</title>
    <link rel="stylesheet" href="ton nom de page.css" />
</head>
<body>
<header>
    <nav>
        <a href="/"></a>
    </nav>
</header>
<main>
    <article>
        <form action='' method='post'>
            <div><h1>Email</h1> <input type="text" name='email'>
                <button type="submit" name='submit' >Submit</button> <br></div>
        </form>
    </article>

</main>
<footer></footer>
</body>
</html>

