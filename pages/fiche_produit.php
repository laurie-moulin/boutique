<?php
session_start(); //Session connexion
$bdd = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', ''); //Database connexion

if(isset($_GET['id_produit']))
{
    $req = $bdd ->prepare("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");  //Request for the verification of login
    $req->execute();
    $resultat = $req->fetchAll();

    var_dump($resultat);

}
if($resultat <= 0)
{
    header("location:boutique.php");
}

//$produit =  $req->fetchAll();
foreach ($resultat as $produit)
{
    echo "<h2>Titre : $produit[titre]</h2><hr><br>";
    echo "<p>Categorie: $produit[categorie]</p>";
    echo "<p>Couleur: $produit[couleur]</p>";
    echo "<p>Taille: $produit[taille]</p>";
    echo "<img src='../images/$produit[photo]' ='500' height='550'>";
    echo "<p><i>Description: $produit[description]</i></p><br>";
    echo "<p>Prix : $produit[prix] €</p><br>";
}

if($produit['stock'] > 0)
{
    echo "<i>Nombre d'produit(s) disponible : $produit[stock] </i><br><br>";
    echo '<form method="post" action="panier.php">';
    echo "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
    echo '<label for="quantite">Quantité : </label>';
    echo '<select id="quantite" name="quantite">';
    for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
    {
        $contenu .= "<option>$i</option>";
    }
    $contenu .= '</select>';



    echo '<input type="submit" name="ajout_panier" value="ajout au panier">';
    $contenu .= '</form>';
}
else
{
    echo 'Rupture de stock !';
}
echo "<br><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";

?>


