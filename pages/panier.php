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

        //$id_produit, $titre, $stock, $prix, $taille
        if(isset($_GET['delPanier']))
        {
            $panier->supprimerArticle($_GET['id_produit']);
            var_dump();
        }
    }




if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
    session_destroy();
}














/*$ids = array_keys($_SESSION['panier']);

echo "<pre>";
var_dump($ids);
echo "</pre>";

if(empty($ids)){
    $products = array();
}else{
    $products = $product->test($ids);
}
foreach($products as $product):
    */?><!--
    <div class="row">
        <a href="#" class="img"> <img src="../img/<?/*= $product->photo; */?>" height="53"></a>
        <span class="name"><?/*= $product->titre; */?></span>
        <span class="name"><?/*= $product->id_produit; */?></span>
        <span class="name"><?/*= $product->prix; */?></span>
        <span class="name"><?/*= $product->taille; */?></span>
        <span class="name"><?/*= $product->stock; */?></span>-->
        <!--<span class="price"><?/*= number_format($product->prix,2,',',' '); */?> €</span>
        <span class="quantity"><input type="text" name="panier[quantity][<?/*= $product->id_produit; */?>]" value="<?/*= $_SESSION['panier'][$product->id]; */?>"></span>
        <span class="subtotal"><?/*= number_format($product->prix * 1.196,2,',',' '); */?> €</span>-->
      <!--  <span class="action">
					<a href="panier.php?delPanier=<?/*= $product->id_produit; */?>" class="del"><img src="../img/trash.png"></a>
				</span>
    </div>-->
<?php /*endforeach; */?>






<?php



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

/*echo "<pre>";
var_dump( $_SESSION['panier']);
echo "<pre>";*/


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



/*
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
            'stock' =>  $_POST['stock'],
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
        echo "<pre>";
        var_dump( $_SESSION['panier']);
        echo "<pre>";

        echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . $panier->montantTotal($value["id_produit"], $value["stock"], $value["prix"]). " euros</td></tr>";

    }*/




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

                        <td><a href="panier.php?delPanier=<?= $_SESSION['panier']['id_produit'][$i] ?>" class="del"><img src="../img/trash.png"></a></td>

                    </tr>
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