<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/commands.php';

session_start();

$product = new \db\product();
$panier = new \db\panier();
$commands = new \db\Commands();
?>




<?php

if (isset($_POST["payer"]))
{
     $commands->insertcommande(2, $commands->montant(),date('Y-m-d'));
     {
        foreach($_SESSION["panier"] as $keys => $values)
        $commands->insertcommandedetail($commands->Last_id(), 2,$values["item_id"], $values["item_quantity"] , $values["item_price"]);
     }
    header('location:paiement_paypal.php');

}

?>



