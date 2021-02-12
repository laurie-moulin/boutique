<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';

session_start();

$product = new \db\product();
$panier = new \db\panier();




if(isset($_POST['ajout_panier']))
    {
        $boucle1 = $panier->ajouterProduitDansPanier( $_GET['id_produit'], $product->panier_produit()['titre'], $_POST['stock'],  $product->panier_produit()['prix'], $_POST['size'], $product->panier_produit()['photo']);
    }


if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
    session_destroy();
}



var_dump($_SESSION);




//--- PAIEMENT ---//
/*if(isset($_POST['payer']))
{
for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++)
{
    $produit = $panier->test()[$i];

if( $produit['stock'] < $_SESSION['panier']['stock'][$i])
{
        echo '<hr><div class="erreur">Stock Restant: ' .  $produit['stock'] . '</div>';

    echo  '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['stock'][$i] . '</div>';


if( $produit['stock'] > 0)
{
    echo '<div class="erreur">la quantité de l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
$_SESSION['panier']['stock'][$i] =  $produit['stock'];
}
else
{
    echo  '<div class="erreur">l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
$panier->retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
$i--;
}
$erreur = true;
}
}*/




/*if(!isset($erreur))
{
   executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
    $id_commande = $mysqli->insert_id;
for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
{
       executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
   }
unset($_SESSION['panier']);
mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:vendeur@dp_site.com");
$contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
}
}*/









/*if(!isset($_SESSION['panier']))
{

    $_SESSION['panier'][]= array(
        'titre' => "",
        'id_produit' => "",
        'stock' => "",
        'taille' => "",
        'prix' => "",
        'photo' => ""
    );
}
else
{
    if(isset($_POST['ajout_panier']))
    {
       $test =  $_SESSION['panier'][]= array(
            'titre' => $product->panier_produit()['titre'],
            'id_produit' => $_GET['id_produit'],
            'stock' =>  $_POST['stock'],
            'taille' => $_POST['size'],
            'prix' =>  $product->panier_produit()['prix'],
            'photo' => $product->panier_produit()['photo']
        );
        implode( ',', $test );
    }
}*/



/*foreach($_SESSION['panier'] as $keya =>$key)
{
    echo "<tr><td>".$keya."</td><td>".$key."</td><td></td><td></td></tr>";

}*/
/*
if (isset($_SESSION['panier']))
{
    foreach ($_SESSION['panier'] as  $value)
    {

        echo $value["id_produit"] ."<br>";
        echo $value["titre"]."<br>";
        echo $value["stock"]."<br>";
        echo $value["taille"]."<br>";
        echo $value["prix"]."<br>";
        echo $value["photo"]."<br>";
    }

    echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . $panier->montantTotal($_GET['id_produit'], $_POST['stock'], $product->panier_produit()['prix']) . " euros</td></tr>";


}*/



/*var_dump($_SESSION);
if(empty($_SESSION['panier'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";

    $_SESSION['panier'][]= array(
        'titre' => "",
        'id_produit' => "",
        'stock' => "",
        'taille' => "",
        'prix' => "",
        'photo' => ""
    );

}
else
{
    if(isset($_POST['ajout_panier']))
    {
        $test =  $_SESSION['panier'][]= array(
            'titre' => $product->panier_produit()['titre'],
            'id_produit' => $_GET['id_produit'],
            'stock' =>  ($_POST['stock']),
            'taille' => $_POST['size'],
            'prix' =>  $product->panier_produit()['prix'],
            'photo' => $product->panier_produit()['photo']
        );
        implode( ',', $test );

        foreach ($_SESSION['panier'] as  $value)
        {
            echo $value["id_produit"] ."<br>";
            echo $value["titre"]."<br>";
            echo $value["stock"]."<br>";
            echo $value["taille"]."<br>";
            echo $value["prix"]."<br>";
            echo $value["photo"]."<br>";
        }


        echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . $panier->montantTotal((int)($value["id_produit"]), (int)($value["stock"]), (int)($value["prix"])). " euros</td></tr>";

    }
    }
*/



   /* if(internauteEstConnecte())
    {
        echo '<form method="post" action="">';
        echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
        echo '</form>';
    }
    else
    {
        echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
    }
    echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";*/




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
   if(empty($_SESSION['panier']['id_produit'])){
          ?>
                <tr><td colspan='10'>Votre panier est vide</td></tr>
            <?php
     }
            else
            {
                for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) {
                   ?>
                    <tr>
                        <td><?= $_SESSION['panier']['id_produit'][$i]?></td>
                        <td><?=$_SESSION['panier']['titre'][$i] ?></td>
                        <td><?=$_SESSION['panier']['stock'][$i] ?></td>
                        <td><?= strtoupper($_SESSION['panier']['taille'][$i])?></td>
                        <td><?=$_SESSION['panier']['prix'][$i] ?> €</td>
                        <td><img width="45" height="55" src=../img/<?=$_SESSION['panier']['photo'][$i] ?>></td>

                        <form method="post" action="">
                            <input type="hidden" name="position" value="<?= $_SESSION['panier']['id_produit'] ?>">
                            <td> 									<input type="submit" name="delete" value="❌">
                            </td>
                        </form>
          <?php }
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