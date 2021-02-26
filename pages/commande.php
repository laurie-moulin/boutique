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
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/shop.css" />
    <title>Commande</title>
</head>

<body>

<header>
    <nav>
        <a href="../pages/boutique_all.php">Boutique</a>
    </nav>
</header>

<main>
    <p class="nav_adresse">LIVRAISON ET PAIEMENT > <span class="span_livraison">RESUMÉ</span></p>
    <section class="all_delivery">
    <section>
        <article class="delivery_title">
            <img src="../img/camion.png">
            <h1>LIVRAISON GRATUITE</h1>
            <p>Livraison gratuite et recevez votre colis en 2 à 5 jours ouvrés,
                chez vous, en bureau de poste ou en point retrait.</p>
        </article>
    </section>

<article class="form_adresse">
    <?php
    if (isset($_POST["payer"]))
    {
    ?>
    <form class="commande_adresse" method="post" action="commande.php">

        <h1 class="titre">ENREGISTRER VOTRE ADRESSE ET VALIDER LA COMMANDE</h1>
        <div class="form_adresse_detail">
            <input type="text" id="adresse" name="adresse" placeholder="Adresse" required><br>
            <input type="text" id="code" name="code" placeholder="Code postal" required><br>
            <input type="text" id="nom" name="ville" placeholder="Ville" required><br>
            <input type="tel" id="phone" name="phone" placeholder="Phone" required>
            <input class="submit_adresse" type="submit" name="enregistrer" value="PAYEZ"><br>
        </div>
    </form>
    <?php
    }
    ?>
   </article>
    </section>

</main>

<footer>

</footer>

</body>
</html>