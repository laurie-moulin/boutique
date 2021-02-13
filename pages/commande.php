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
    echo $commands->montant();
}

?>



