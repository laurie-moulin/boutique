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

        echo "<pre>";
        var_dump($_SESSION["panier"]);
        echo "<pre>";

    }
}


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
    </nav>
</header>
<main>
    <section>
        <table border='1' style='border-collapse: collapse' cellpadding='7'>
            <tr><td colspan='5'>Panier</td></tr>
            <tr><th>ID</th><th>TITRE</th><th>QUANTITE</th><th>PRIX UNITAIRE</th><th>TAILLE</th><th>Prix Unitaire</th></tr>

            <?php
            if(empty($_SESSION['panier']['id_produit'])) // panier vide
            {
                echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
            }
            else
            {
                for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
                {
                    echo "<tr>";
                    echo "<td>" . $_SESSION['panier']['id_produit'][$i]. "</td>";
                    echo "<td>" . $_SESSION['panier']['titre'][$i]  . "</td>";
                    echo "<td>" . $_SESSION['panier']['stock'][$i] . "</td>";
                    echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
                    echo "<td>" . strtoupper($_SESSION['panier']['taille'][$i]) . "</td>";
                    echo "<td>" . strtoupper($_SESSION['panier']['photo'][$i]) . "</td>";
                    echo "</tr>";

                    var_dump($_SESSION['panier']['taille'][$i]);
                }
                echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . $panier->montantTotal() . " euros</td></tr>";
                if($panier->internauteEstConnecte())
                {
                    echo '<form method="post" action="">';
                    echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
                    echo '</form>';
                }
                else
                {
                    echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
                }
            }

            ?>
        </table>
    </section>

</main>
<footer></footer>
</body>
</html>