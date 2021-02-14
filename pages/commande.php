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
var_dump($_SESSION["panier"][0]);
/*if (isset($_POST["payer"]))
{
foreach($_SESSION["panier"] as $keys => $values)
{
    $commands->insertcommande(16, $commands->montant(),date('Y-m-d'), $values["item_id"], $values["item_quantity"], $values["item_price"], $values["item_size"]);
    $commands->UpdateStock($values["item_quantity"], $values["item_id"], $values["item_size"]);



//     header('location:paiement_paypal.php');
}
}*/


if (isset($_POST["payer"]))
{
       $commands->insertcommande(20, $commands->montant(),date('Y-m-d'));
       $lastID = $commands->lastInsertId();
        foreach($_SESSION["panier"] as $keys => $values)
        {
            $commands->insertcommandedetail($lastID,20,$values["item_id"], $values["item_quantity"], $values["item_price"], $values["item_size"]);
            $commands->UpdateStock($values["item_quantity"], $values["item_id"], $values["item_size"]);
        }

//     header('location:paiement_paypal.php');
}

?>



