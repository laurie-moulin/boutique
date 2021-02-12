<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';

session_start();

$product = new \db\product();
$panier = new \db\panier();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Produits</title>
</head>

<body>
<header>
</header>
<main>
    <section>
        <?php
        if (isset($_GET['id_produit']))
        {
            $product->details_produit() ?>
                <div class="boutique-produit">
                    <h2><?=$product->details_produit()["titre"]?></h2>
                    <img src=../img/<?=$product->details_produit()["photo"]?> ="500" height="550">
                    <p><?=number_format($product->details_produit()["prix"] ,2,',',' ') ?> €</p>
                    <p><?=$product->details_produit()["description"] ?> </p>
                </div>
            <?php }
        else
        {
            header("location:boutique_all.php");
        }
        ?>

    </section>

    <section>
        <form method="post" action="panier.php?id_produit=<?= $product->details_produit()["id_produit"] ?>">
                <label for="taille">Choisir taille:</label>
                <select  name="size" id="taille">
                    <?php
                    $i = 0;
                    $stock = 0;
                    foreach ($product->getSizes() as $size) {
                        if($i == 0)
                        {
                            $stock = $size["stock"];
                        }
                        ++$i;
                        ?>
                        <option value="<?= $size["taille"] ?>" data-value-stock="<?= $size["stock"] ?>"><?= strtoupper($size["taille"]) ?></option>
                    <?php } ?>
                </select>

                <label for="quantite">Quantité:</label>
                <select name="stock" id="quantite" >
                    <?php
                    if ($size['stock'] > 0){
                        for($i = 1; $i <= $size['stock'] && $i <= 5; $i++) {
                            ?>
                            <option><?=$i?></option>";
                        <?php }
                    }
                    else
                    {
                        echo "Rupture de stock";
                    }
                    ?>
                </select>
            <input type="submit" name="ajout_panier" value="ajout au panier">
        </form>
    </section>
    <a href='boutique_all.php'>Revenir à la boutique</a>

</main>
<footer>

</footer>

</body>
</html>

