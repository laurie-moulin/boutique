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

    header('location:paiement_paypal.php');
}

?>



