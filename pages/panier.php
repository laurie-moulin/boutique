<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/commands.php';


session_start();

$product = new \db\product();
$panier = new \db\panier();
$commands = new \db\Commands();

if(isset($_POST["ajout_panier"]))
{
 $panier->creationDuPanier();
 $panier->creation_shop_icon();
 //header('location:boutique_all.php');

}

if(isset($_GET["action"]))
{
  $panier->delete();
}
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
    unset($_SESSION["icon_shop"]);
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Utilisation de main</title>
    <link rel="stylesheet" href="../css/shop.css" />
</head>
<body>
<header>
    <nav>
        <a href="/"></a>
    </nav>
    <article>
        <?php
        if(isset($_SESSION["icon_shop"]))
        {
            echo "<div class='test'>";
            echo  $_SESSION["icon_shop"] ;
            echo "</div>";
        }
        ?>
    </article>
</header>
<main>
    <article>

        <table border='1' style='border-collapse: collapse' cellpadding='7'>
            <tr><td colspan='10'>Panier</td></tr>
            <tr><th>nom</th><th>quantité</th><th>prix</th><th>taille</th><th>prix</th><th>photo</th><th>SUPPRIMER</th></tr>
            <?php
            if(!empty($_SESSION["panier"]))
            {
            $total = 0;
            foreach($_SESSION["panier"] as $keys => $values)
            {?>
                <tr>
                    <td><?=  $values["item_name"] ?></td>
                    <td><?=  $values["item_quantity"]?></td>
                    <td><?=  $values["item_price"] ?></td>
                    <td><?=  strtoupper($values["item_size"]) ?></td>
                    <td><?=  number_format($values["item_quantity"] * $values["item_price"], 2)?> €</td>
                    <td><img width="45" height="55" src="../img/<?= $values["item_photo"] ?>" class="img-responsive" /></td>
                    <td><a href="panier.php?action=delete&id=<?=  $values["item_id"] ?>"><span class="text-danger">Remove</span></a></td>
                </tr>
                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right"> <?= number_format($total, 2) ?> euros</td>
                <td></td>
            </tr>
        </table>
        <?php
        if($panier->internauteEstConnecte())
        {?>
            <form method="post" action="commande.php">
            <tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement">Payer</td></tr>
            </form>
        <?php}
        else
        {?>
            <form method="post" action="commande.php">
                <input type="hidden" name="total" value="<?= number_format($total, 2)  ?>" />
                <tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>
            </form>
            <tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>
            <?php
        }
        echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
        }
        else
        {
            echo "Votre panier est vide";
        }
        ?>
        <a href="detail_produit.php">revenir</a>

        <form method="post" action="commande.php">
            <input type="hidden" name="total" value="<?= number_format($total, 2)  ?>" />
            <tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>
        </form>
        <tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>
    </article>

</main>
<footer></footer>
</body>
</html>