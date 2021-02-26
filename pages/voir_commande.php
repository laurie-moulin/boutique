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


<?php
var_dump($_SESSION["id"]);
if(isset($_SESSION["id"]))
{
foreach($product->get_profil_commande() as $keys => $values)
{
    ?>
    <div class="bask_panier_flex">
        <?= "NOM : ". strtoupper($values["nom"] ) ?><br>
        <?=  "PRENOM : ". $values["prenom"]." "?><br>
        <?=   "EMAIL : ".$values["email"] ?><br>
        <?=  "ADRESSE : ".strtoupper($values["adresse"]) ." ||"?>
        <?=  "CODE POSTAL : ".strtoupper($values["code_postal"]) ." ||"?>
        <?=  "VILLE : ".strtoupper($values["ville"]) ?><br>
        <?=  "TELEPHONE : ".strtoupper($values["telephone"])?>
    </div>
    <?php
}
?>
    <?php
    foreach($product->getCommande() as $keys => $values)
    {
    ?>
        <?= "NUMERO DE COMMANDE : ". strtoupper($values["id_commande"] ) ?><br>
        <?=  "PRIX TOTAL : ". $values["montant"]." "?><br>
        <?=   "DATE : ".$values["date_enregistrement"] ?><br>
    <?php  }?>

    <a href="detail_page_commande.php?id_commande=<?= $values['id_commande'] ?>">Voir le detail de la commande</a>




<?php
}
?>




