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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/shop.css" />
    <link rel="stylesheet" href="../css/zoro.css" />
    <title>Panier</title>
</head>
<body>
<header>
    <?php
    include '../includes/nav.php';
    ?>
</header>
<main>
    <!-- Container general de la page //////////////////////////   -->
    <div class="container_general">
    <article class="responsive_basket1">
        <h1 class="panier_achat">PANIER D'ACHAT</h1>

            <?php
            if(!empty($_SESSION["panier"]))
            {
            $total = 0;
            foreach($_SESSION["panier"] as $keys => $values)
            {?>

                <div class="bask_panier_flex">
                    <?= "TITRE : ". strtoupper($values["item_name"] )." ||" ?>
                    <?=  "QUANTITÉ : ". $values["item_quantity"]." ||"?>
                    <?=   "PRIX A L'UNITÉ : ".$values["item_price"] ." EUR" ." ||"?>
                    <?=  "TAILLE : ".strtoupper($values["item_size"]) ." ||"?>
                    <?=  "TOTAL : ".number_format($values["item_quantity"] * $values["item_price"], 2)."EUR" ." ||"?>
                    <img width="45" height="55" src="../img/imgboutique/<?= $values["item_photo"] ?>" class="img-responsive" />
                     <a href="panier.php?action=delete&id=<?=  $values["item_id"] ?>"><img class="trash_basket" src="../img/trash2.png"></a>
                </div>
                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>
                <span class="panier1_achat"> PRIX FINAL   ||   <?= number_format($total, 2) ?> EUR</span>
            <?php
            if(isset($_SESSION['id']))
            {
                ?>

                <form method="post" action="commande.php">
                    <input type="hidden" name="total" value="<?= number_format($total, 2)  ?>" />
                   <input class="panier6_achat" type="submit" name="payer" value="Valider et déclarer le paiement">
                </form>
                <span class="panier_achat"><a class="user_font" href='?action=vider'>Vider mon panier</a></span>
                <?php
            }
            else
            {?>
              <span class="panier_achat">Veuillez vous <a class="user_font" href="../user/inscription.php">INSCRIRE</a> ou vous <a class="user_font" href="../user/connexion.php">CONNECTER</a> afin de pouvoir payer</span>
               <span class="panier_achat"><a class="user_font" href='?action=vider'>VIDER MON PANIER</a></span>
                <?php
            }
        }
        else
        {
            echo "<span class='empty_basket'>Votre panier est vide</span>";
        }
        ?>

    </article>
    <h1 class="nouveaute">NOUVEAUTÉS</h1>
    <section class="picture_category">
    <?php
          foreach ($commands->nouveaute() as $new) { ?>
              <div class="flex_product5">
                  <span class="new_article">NEW</span>
                  <a href = detail_produit.php?id_product=<?= $new["id_product"] ?>><img src=../img/imgboutique/<?=$new["photo"]?> ="500" height="400"></a>
                  <span class="text_decriptionnews"><?=strtoupper($new["description"]) ?></span<br><br>
                  <?="<span class='text_police' >".$new["prix"] ." EUR</span>"?>
                </div>
            <?php }?>
    </section>
        <!--     FIN CONTAINER GENERAL       -->
    </div>
</main>
<footer></footer>
</body>
</html>