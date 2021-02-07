<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';

session_start();

$product = new \db\product();
$panier = new \db\panier();


if(isset($_GET['id_produit']))
{
    if(isset($_POST['ajout_panier']))
    {   // debug($_POST);
        $product->panier_produit();
        $panier->ajouterProduitDansPanier( $product->details_produit()['titre'],$_POST['id_produit'],$_POST['stock'], $product->details_produit()['prix'], $_POST['size']);

        echo "<pre>";
        var_dump( $_POST);
        echo "<pre>";


    }
}

$contenu ="";
echo $contenu;
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix Unitaire</th></tr>";

if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
    echo "<tr><td colspan='5'>Votre panier contient des produits</td></tr>";
}
echo "</table><br>";
echo "<i>Réglement par CHÈQUE uniquement à l'adresse suivante : 300 rue de vaugirard 75015 PARIS</i><br>";
echo "<hr>session panier:<br>";



?>
