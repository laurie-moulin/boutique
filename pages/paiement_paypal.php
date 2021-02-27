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

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>paimenent</title>
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/shop.css" />
</head>
<body>
<header>
    <nav>
        <a></a>
    </nav>
</header>
<main>
    <p class="nav_adresse"><span class="span_livraison">LIVRAISON ET PAIEMENT</span> > RESUMÉ</p>
    <article class="paiement_paypal_adresse">
      <h1>RECAPITULATIF DE LA COMMANDE </h1>
        <h2>ADRESSE</h2>
        <section class="Policie_adresse">
        <?php foreach ($product->affichages_adresse() as $adresses)
        {?>
            <?= strtoupper($adresses["adresse"])?><br>
            <?= $adresses["code_postal"]?>
            <?= strtoupper($adresses["ville"])?><br>
            <?= $adresses["telephone"]?>

        <?php }?>
        </section>
    </article>
    <article class="paiement_paypal_adresse">
        <h2>DETAIL COMMANDE</h2>

            <?php
            if(!empty($_SESSION["panier"]))
            {
            $total = 0;
            foreach($_SESSION["panier"] as $keys => $values)
            {
                ?>
                <div class="bask_panier_flex">
                    <?= "TITRE : ". strtoupper($values["item_name"] )." ||" ?>
                    <?=  "QUANTITÉ : ". $values["item_quantity"]." ||"?>
                    <?=   "PRIX A L'UNITÉ : ".$values["item_price"] ." EUR" ." ||"?>
                    <?=  "TAILLE : ".strtoupper($values["item_size"]) ." ||"?>
                    <?=  "TOTAL : ".number_format($values["item_quantity"] * $values["item_price"], 2)."EUR" ?>
                    <img width="45" height="65" src="../img/<?= $values["item_photo"] ?>" class="img-responsive" />
                </div>
                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>
                <h3>PRIX TOTAL</h3>
                <?= number_format($total, 2). " EUR" ?>
        <?php
        }
        else
        {
            header('location:voir_commande.php');
        }
        ?>
    </article>
    <article class="paypal">
        <?php
    /* Les variables suivantes doivent être personnalisées selon vos besoins */
    $email_paypal= 'seller_xxxxxxx_biz@gmail.com';/*email associé au compte paypal du vendeur*/
    $item_numero = $values["item_id"] ; /*Numéro du produit en vente*/
    $item_prix   = $total;    /*prix du produit*/
    $item_nom    = $values["item_name"] ; /*Nom du produit*/
    $url_retour='http://www.memo-web.fr/paypal-remerciement.php';/*page de remerciement à créer*/
    $url_cancel='http://www.memo-web.fr/paypal-annulation.php'; /*page d'annulation d'achat*/
    $url_confirmation='http://www.memo-web.net/paypal-confirmation.php';/*page de confirmation d'achat*/
    /* fin déclaration des variables / ce lien c'est pour allez sur paypal ! https://www.paypal.com/cgi-bin/webscr */
    echo '
      <form   action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="cmd" value="_xclick"/>
      <input type="hidden" name="business" value="'.$email_paypal.'"/>
      <input type="hidden" name="item_name" value="'.$item_nom.'"/>
      <input type="hidden" name="item_number" value="'.$item_numero.'"/>
      <input type="hidden" name="amount" value="'.$item_prix.'"/>
      <input type="hidden" name="currency_code" value="EUR"/>
      <input type="hidden" name="no_note" value="1"/>
      <input type="hidden" name="no_shipping" value="0"/>
      <input type="hidden" name="lc" value="FR"/>
      <input type="hidden" name="notify_url" value="'.$url_confirmation.'"/>
      <input type="hidden" name="cancel_return" value="'.$url_cancel.'">
      <input type="hidden" name="return" value="'.$url_retour.'">
      <h2 class="paypal_line">PAIEMENT PAR PAYPAL</h2>
      <input class="size_image" align="right" valign="center" type="image" alt="Paiement par Paypal" src="../img/buy-logo-large-fr.png" border="0" name="submit" alt="Paiement sécurisé par paypal"/>
      </form> ';

    unset($_SESSION["panier"]);

    ?>
    </article>

    <section>
        <p class="paypal_line1">J'AI LU ET J'ACCEPTE LES CONDITIONS GÉNÉRALES DACHAT ET J'AI COMPRIS LA POLITIQUE DE CONFIDENTIALITÉ ET EN MATIÈRE DE COOKIES.</p>
    </section>
</main>
<footer></footer>
</body>
</html>