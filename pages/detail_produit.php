<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';

$product = new \db\product();
$panier = new \db\panier();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/shop.css"/>
    <link rel="stylesheet" href="../css/product.css"/>
    <title>Produits</title>

</head>

<body>

<header>
</header>

<main>


    <article>
        <?php
        if (isset($_SESSION["icon_shop"])) {
            echo "<div class='test'>";
            echo $_SESSION["icon_shop"];
            echo "</div>";
        }
        ?>
    </article>
    <article><a href="panier.php">Panier</a></article>
    <section>
        <?php
        if (isset($_GET['id_product'])) {
            $product->details_produit() ?>
            <div class="boutique-produit">
                <h2><?= $product->details_produit()["nom"] ?></h2>
                <img width="300px" src=../img/imgboutique/<?= $product->details_produit()["photo"] ?> >
                <p><?= number_format($product->details_produit()["prix"], 2, ',', ' ') ?> €</p>
                <p><?= $product->details_produit()["description"] ?> </p>
            </div>
        <?php } else {
            header("location:boutique_all.php");
        }
        ?>
    </section>

    <section>
        <form method="post" action="panier.php?id_product=<?= $product->details_produit()["id_product"] ?>">
            <input type="hidden" name="hidden_name" value="<?php echo $product->details_produit()["nom"]; ?>"/>
            <input type="hidden" name="hidden_price" value="<?php echo $product->details_produit()["prix"]; ?>"/>
            <input type="hidden" name="hidden_photo" value="<?php echo $product->details_produit()["photo"]; ?>"/>

            <label for="taille">Choisir taille:</label>
            <select name="size" id="taille">
                <?php
                $i = 0;
                $stock = 0;
                foreach ($product->getSizes() as $size) {
                    if ($i == 0) {
                        $stock = $size["stock"];
                    }
                    ++$i;
                    ?>
                    <option value="<?= $size["taille"] ?>"
                            data-value-stock="<?= $size["stock"] ?>"><?= strtoupper($size["taille"]) ?></option>
                <?php } ?>
            </select>

            <label for="quantite">Quantité:</label>
            <select name="quantity" id="quantite">
                <?php
                $i = 0;
                while ($i < $stock && $i <= 4) {
                    $i++; ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php }
                ?>
            </select>
            <input type="submit" name="ajout_panier" value="ajout au panier">
        </form>
    </section>
    <a href='boutique_all.php'>Revenir à la boutique</a>

    <!--    AVIS CLIENT-->

    <form method="post" action="detail_produit.php?id_product=<?= $product->details_produit()["id_product"] ?>">

        <h1>Laisser un avis</h1>

        <textarea name="comment" rows="5" cols="33">Laisse ton avis ! </textarea><br><br>

        <div class="rating"><!--
        --><input name="stars" id="e5" type="radio" value="5"></a><label for="e5">★</label><!--
		--><input name="stars" id="e4" type="radio" value="4"></a><label for="e4">★</label><!--
		--><input name="stars" id="e3" type="radio" value="3"></a><label for="e3">★</label><!--
		--><input name="stars" id="e2" type="radio" value="2"></a><label for="e2">★</label><!--
		--><input name="stars" id="e1" type="radio" value="1"></a><label for="e1">★</label>
        </div>

        <?php
        if(isset($_POST['submit_comment']))
        {
            $product->comments();
        }
        ?>

        <input type="submit" name="submit_comment" value="laisser un avis">

    </form>

    <h1>Les avis des clients sur ce produit</h1>

    <?php



       foreach ($product->getComments() as $comments) { ?>
    commentaire :<br>  <?= $comments['comment'] ?><br>

    <img width="100px" src="../img/stars/<?= $comments['stars'] ?>.png"><br>
    <?php } ?>



</main>
<footer>
</footer>

</body>
</html>

