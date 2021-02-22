<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/commands.php';
require_once '../class/admin.php';
require_once '../class/user.php';
require_once '../class/admin.php';


$product = new \db\product();
$panier = new \db\panier();
$commands = new \db\Commands();
$admin = new \db\admin();
$user = new \db\admin();

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

var_dump($user);

?>

<?php

if (isset($_POST["payer"]))
{
   $commands->insertcommande($user, $commands->montant(),date('Y-m-d'));

    $lastID = $commands->lastInsertId();

    foreach($_SESSION["panier"] as $keys => $values)
    {
        $commands->insertcommandedetail($lastID,$user,$values["item_id"], $values["item_quantity"], $values["item_price"], $values["item_size"]);
    }
    $commands->UpdateStock($values["item_quantity"], $values["item_id"], $values["item_size"]);

    $adresse = htmlspecialchars($_POST["adresse"]);
    $code = htmlspecialchars($_POST["code"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $phone = htmlspecialchars($_POST["phone"]);

    $commands->insert_adresses($user, $adresse, $code, $ville, $phone);


    header('location:paiement_paypal.php');
}

?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>

<body>

<header>
    <nav>
        <a href="../pages/boutique_all.php">Boutique</a>
    </nav>
</header>

<main>

</main>

<footer>

</footer>

</body>
</html>