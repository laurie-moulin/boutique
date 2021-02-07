<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';

session_start();

$product = new \db\product();
$panier = new \db\panier();


if(isset($_GET['id_produit']))
{
    $products = $panier->add_panier();
    if(empty($products))
    {
        echo "Ce produit n'existe pas";
    }
    $panier->add(["id_produit"]);

    die('Ce produit a été ajouté au panier');
}
else
{
    echo "Vous n'avez pas selectionné de produit à ajouter dans ce panier !";
}

?>