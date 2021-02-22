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
    <link rel="stylesheet" href="../css/shop.css" />
</head>
<body>
<header>
    <nav>
        <a></a>
    </nav>
</header>
<main>
    <article>
        <table>
            <article><h1>RECAPITULATIF DE LA COMMANDE ET PAIEMENT</h1></article>
            <?php
            if(!empty($_SESSION["panier"]))
            {
            $total = 0;
            foreach($_SESSION["panier"] as $keys => $values)
            {
                ?>
                <tr>
                    <td><?=  $values["item_name"] ?></td>
                    <td><?=  $values["item_quantity"]?></td>
                    <td><?=  $values["item_price"] ?></td>
                    <td><?=  strtoupper($values["item_size"]) ?></td>
                    <td><?=  number_format($values["item_quantity"] * $values["item_price"], 2)?> €</td>
                    <td><img width="45" height="55" src="../img/<?= $values["item_photo"] ?>" class="img-responsive" /></td>
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
        }
        else
        {
            header('location:boutique_all.php');
        }
        ?>
    </article>
    <?php
    include('paiement.php');
    ?>
    <article

</main>
<footer></footer>
</body>
</html>