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
    {
        $panier->ajouterProduitDansPanier( $_GET['id_produit'], $product->panier_produit()['titre'], $_POST['stock'],  $product->panier_produit()['prix'], $_POST['size'], $product->panier_produit()['photo']);
        //$id_produit, $titre, $stock, $prix, $taille
    }
}
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}

/*if(isset($_GET['suppr']) && $_GET['suppr'] == "supprimerarticle")
{

    if (isset($_SESSION['panier']['id_produit']))
    {
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            unset($_SESSION['panier']['id_produit'][$i]);
            unset($_SESSION['panier']['titre'][$i]);
            unset($_SESSION['panier']['stock'][$i]);
            unset($_SESSION['panier']['taille'][$i]);
            unset($_SESSION['panier']['photo'][$i]);
            unset ($_SESSION['panier']['prix'][$i]);




        }
    }

}*/

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>panier</title>
    <link rel="stylesheet" href="ton nom de page.css" />
</head>
<body>
<header>
    <nav>
        <a href="boutique_all.php">Boutique</a>

    </nav>
</header>
<main>
    <section>
        <table border='1' style='border-collapse: collapse' cellpadding='7'>
            <tr><td colspan='10'>Panier</td></tr>
            <tr><th>ID</th><th>TITRE</th><th>QUANTITE</th><th>TAILLE</th><th>PRIX UNITAIRE</th><th>PHOTO</th><th>SUPPRIMER</th></tr>
            <?php


            if(empty($_SESSION['panier']['id_produit'])) // panier vide
            {
                echo "<tr><td colspan='10'>Votre panier est vide</td></tr>";
            }
            else
            {
                for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
                {
                    echo "<tr>";
                    echo "<td>" . $_SESSION['panier']['id_produit'][$i]. "</td>";
                    echo "<td>" . $_SESSION['panier']['titre'][$i]  . "</td>";
                    echo "<td>" . $_SESSION['panier']['stock'][$i] . "</td>";
                    echo "<td>" . strtoupper($_SESSION['panier']['taille'][$i]) . "</td>";
                    echo "<td>" . number_format($_SESSION['panier']['prix'][$i] ,2,',',' ') . " €</td>";
                    echo "<td>" .'<img width="45" height="55" src="../img/'.$_SESSION['panier']['photo'][$i]. '">'. "</td>";
                    echo "<td colspan='5'><a href='?suppr=supprimerarticle'>Supprimer cet article</a></td>";

                    echo "</tr>";

                }
                echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . $panier->montantTotal() . " euros</td></tr>";

                if($panier->internauteEstConnecte())
                {
                    echo '<form method="post" action="">';
                    echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement">Payer</td></tr>';
                    echo '</form>';
                }
                else
                {
                    echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
                }
                echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
            }

            ?>
        </table>
    </section>

</main>
<footer>



</footer>
</body>
</html>