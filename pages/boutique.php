<?php
session_start(); //Session connexion
$bdd = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', ''); //Database connexion

//--- AFFICHAGE DES CATEGORIES ---//

$req = $bdd ->prepare('SELECT categorie FROM produit');  //Request for the verification of login
$req->execute();
$cat = $req->fetchAll();

foreach ($cat as  $line) {
        echo "<li><a href='?categorie=" . $line["categorie"]  . "'>" . $line["categorie"] . "</a></li>";

}
echo "<a href='boutique.php'>All</a>";


//--- AFFICHAGE DES PRODUITS ---//

if(isset($_GET['categorie']))
{

    $req = $bdd ->prepare("select id_produit,reference,titre,photo,prix from produit where categorie='$_GET[categorie]'");  //Request for the verification of login
    $req->execute();
    $produit = $req->fetchAll();

  foreach ($produit as  $value)
    {
        echo '<div class="boutique-produit">';
        echo"<h2>$value[titre]</h2>";
        echo "<a href=\"fiche_produit.php?id_produit=$value[id_produit]\"><img src=\"../images/$value[photo]\" =\"500\" height=\"550\"></a>";
        echo "<p>$value[prix] €</p>";
        echo'<a href="fiche_produit.php?id_produit=' . $value['id_produit'] . '">Voir la fiche</a>';
        echo '</div>';
    }
}
else
{
    $req = $bdd ->prepare('SELECT * FROM produit');  //Request for the verification of login
    $req->execute();
    $cat1 = $req->fetchAll();

    foreach ($cat1 as $val)
    {
        echo '<div class="boutique-produit">';
        echo"<h2>$val[titre]</h2>";
        echo "<a href=\"fiche_produit.php?id_produit=$val[id_produit]\"><img src=\"../images/$val[photo]\" =\"500\" height=\"550\"></a>";
        echo "<p>$val[prix] €</p>";
        echo'<a href="fiche_produit.php?id_produit=' . $val['id_produit'] . '">Voir la fiche</a>';
        echo '</div>';
    }

}

?>


<h1>hola</h1>

