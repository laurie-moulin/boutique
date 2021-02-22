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

var_dump($user);

?>

<?php

if (isset($_POST["enregistrer"]))
{
   $commands->insertcommande($user, $commands->montant(),date('Y-m-d'));

    $lastID = $commands->lastInsertId();

    foreach($_SESSION["panier"] as $keys => $values)
    {
        $commands->insertcommandedetail($lastID,$user,$values["item_id"], $values["item_quantity"], $values["item_price"], $values["item_size"]);
    }
    $commands->UpdateStock($values["item_quantity"], $values["item_id"], $values["item_size"]);

    $commands->insert_adresses($user);


    header('location:paiement_paypal.php');
}

?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>

<body>

<header>
    <nav>
        <a href="../pages/boutique_all.php">Boutique</a>
    </nav>
</header>

<main>
<article>
    <?php
    if (isset($_POST["payer"]))
    {
    ?>
    <form method="post" action="commande.php">

        <h1 class="titre">Enregistrer votre adresse et validez la commande</h1>

        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse" required><br>

        <label for="code">Code postal</label>
        <input type="text" id="code" name="code" required><br>

        <label for="ville">Ville</label>
        <input type="text" id="nom" name="ville" required><br>

        <label for="phone">Numéro de téléphone</label>
        <input type="tel" id="phone" name="phone" required>

        <tr><td colspan="5"><input type="submit" name="enregistrer" value="Enregistrer"></td></tr>
    </form>
    <?php
    }
    ?>
</article>
</main>

<footer>

</footer>

</body>
</html>