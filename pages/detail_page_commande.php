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
<a href="voir_commande.php">commande</a><br>

<?php
if(isset($_SESSION["id"]))
{
    if(isset($_GET["id_commande"]))
    {
        echo "COMMANDE N°". $_GET["id_commande"];
?>
        <?php
        foreach($product->detail_Commande($_GET["id_commande"]) as $keys => $values)
        {
        ?>
        <div class="bask_panier_flex">

            <?=  "QUANTITÉ : " .$values["quantité"]. " ||"?>
            <?=  "TAILLE : ".strtoupper($values["taille"]) ." ||"?>
            <?=  "ID_PRODUIT: ".$values["id_product"] ?><br>
            <?=  "PRIX A L'UNITÉ : ". $values["prix_produit"]?>
        </div>
            <?php
        }

            ?>



<?php
    }
}
?>

