<?php

require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';

session_start();

$product = new \db\Product();
$panier = new \db\Panier();
$search = new \db\Search();

//var_dump($_SESSION);

if(!empty($_SESSION["panier"]))

{
    $total = 0;
    foreach($_SESSION["panier"] as $keys => $values)

        $values["item_id"] ;
        $values["item_name"] ;
        number_format($values["item_quantity"] * $values["item_price"], 2);
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
}

        $totla = number_format($total, 2);



/* Les variables suivantes doivent être personnalisées selon vos besoins */
$email_paypal= 'seller_xxxxxxx_biz@gmail.com';/*email associé au compte paypal du vendeur*/
$item_numero = $values["item_id"] ; /*Numéro du produit en vente*/
$item_prix   = $totla ;    /*prix du produit*/
$item_nom    = $values["item_name"] ; /*Nom du produit*/
$url_retour='http://www.memo-web.fr/paypal-remerciement.php';/*page de remerciement à créer*/
$url_cancel='http://www.memo-web.fr/paypal-annulation.php'; /*page d'annulation d'achat*/
$url_confirmation='http://www.memo-web.net/paypal-confirmation.php';/*page de confirmation d'achat*/
/* fin déclaration des variables */
echo '
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
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
  <input  align="right" valign="center" type="image" alt="Paiement par Paypal" src=" https://www.paypal.com/fr_FR/i/bnr/horizontal_solution_PP.gif" border="0" name="submit" alt="Paiement sécurisé par paypal"/>
  </form> ';
?>




