<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/commands.php';
require_once '../class/admin.php';
require_once '../class/user.php';
require_once '../class/admin.php';


$product = new \db\product();
$panier = new \db\panier();
$commands = new \db\Commands();
$admin = new \db\admin();
$user = new \db\admin();

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}


if(isset($_POST["ajout_panier"]))
{
 $panier->creationDuPanier();
 //$panier->creation_shop_icon();
 //header('location:boutique_all.php');
}

if(isset($_GET["action"]))
{
  $panier->delete();
}
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
    //unset($_SESSION["icon_shop"]);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/shop.css" />
    <title>Panier</title>
</head>
<body>
<header>
    <nav>
    </nav>
    <article>
        <?php
     /*   if(isset($_SESSION["icon_shop"]))
        {
            echo "<div class='test'>";
            echo  $_SESSION["icon_shop"] ;
            echo "</div>";
        }*/
        ?>
    </article>
</header>
<main>
    <article>
        <h1>PANIER D'ACHAT</h1>
        <table>
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
                    <td><a href="panier.php?action=delete&id=<?=  $values["item_id"] ?>"><img class="trash_basket" src="../img/trash2.png"></a></td>
                </tr>
                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>

            <tr class="td_total">
                <td>Total</td>
                <td> <?= number_format($total, 2) ?> EUR</td>
                <td></td>
            </tr>


        </table>
            <?php
            if(isset($_SESSION['id']))
            {
                ?>
                <a href="../user/profil.php">Profil</a>

                <form method="post" action="commande.php">
                    <input type="hidden" name="total" value="<?= number_format($total, 2)  ?>" />
                    <tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>
                </form>
                 <tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>

                <?php
            }
            else
            {?>

                <tr><td colspan="3">Veuillez vous <a href="../user/inscription.php">inscrire</a> ou vous <a href="../user/connexion.php">connecter</a> afin de pouvoir payer</td></tr>
                <tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>

                <?php
            }
        }
        else
        {
            echo "Votre panier est vide";

        }
        ?>

        <a href="detail_produit.php"> revenir</a>

    </article>
    <section class="picture_category4">
    <?php
          foreach ($commands->nouveaute() as $new) { ?>
                <div>
                    <h2><?=$new["nom"]?></h2>
                    <a href = detail_produit.php?id_product=<?= $new["id_product"] ?>><img src=../img/<?=$new["photo"]?> ="500" height="550"></a>
                    <p><?=$new["prix"] ?> €</p>
                    <p><?=$new["description"] ?> </p>
                    <p class="new_article">NEW</p>
                </div>
            <?php }?>
    </section>

</main>
<footer></footer>
</body>
</html>