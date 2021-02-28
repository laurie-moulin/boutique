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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/shop.css" />
    <link rel="stylesheet" href="../css/product.css" />
    <title>Produits</title>

</head>

<body>

<header>
</header>

<main>

    <!-- Container general de la page //////////////////////////   -->
    <div class="container_general">

        <!--   Partie en attente header    -->
        <div class="wait_header">
            <article>
                <?php
                /*  if(isset($_SESSION["icon_shop"]))
                  {
                      echo "<div class='test'>";
                      echo  $_SESSION["icon_shop"] ;
                      echo "</div>";
                  }*/
                ?>
            </article>
            <article><a href="panier.php">Panier</a> </article>
            <a href='boutique_all.php'>Revenir à la boutique</a>
        </div>

        <!--   Partie top (green) ///////////-->
        <section class="picture2_category">

            <?php
            if (isset($_GET['id_product']))
            {
                $product->details_produit() ?>
                <div class="boutique-produit">
                    <h2><?=strtoupper($product->details_produit()["nom"])?></h2>
                    <img src=../img/imgboutique/<?=$product->details_produit()["photo"]?> ="500" height="550"><br>
                    <?=strtoupper($product->details_produit()["description"]) ?><br>
                    <?=number_format($product->details_produit()["prix"] ,2,',',' ') . " EUR"?><br>
                </div>
            <?php }
            else
            {
                header("location:boutique_all.php");
            }
            ?>

                <!--   partie quantité     -->
                <section class="flex_detail_product">

                    <form method="post" action="panier.php?id_product=<?= $product->details_produit()["id_product"] ?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $product->details_produit()["nom"]; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $product->details_produit()["prix"]; ?>" />
                        <input type="hidden" name="hidden_photo" value="<?php echo $product->details_produit()["photo"]; ?>" />

                        <article class="select_flex">
                            <div>
                                <label for="taille"></label>
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
                            </div>
                            <div>
                                <label for="quantite"></label>
                                <select name="quantity" id="quantite" >
                                    <?php
                                    $i = 0;
                                    while ($i < $stock && $i <= 4) {
                                        $i++; ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php }
                                    ?>
                                </select><br><br>
                            </div>
                        </article>
                        <input type="submit" name="ajout_panier" value="Ajouter au panier">
                    </form>

                </section>
                <!-- FIN  partie quantité     -->

        </section>
        <!-- /////// FIN Partie top (green) ///////////-->


        <!--    Container partie bottom (gold)    -->
        <article  class="picture3_category">

            <!--    AVIS CLIENT-->
            <form class="picture3_category_form" method="post" action="detail_produit.php?id_product=<?= $product->details_produit()["id_product"] ?>"><br>

                <h1>Laisser un avis</h1>

                <textarea name="comment" rows="3" cols="80">Laisse ton avis ! </textarea><br>

                <div class="rating"><!--
            --><input name="stars" id="e5" type="radio" value="5"></a><label for="e5">★</label><!--
            --><input name="stars" id="e4" type="radio" value="4"></a><label for="e4">★</label><!--
            --><input name="stars" id="e3" type="radio" value="3"></a><label for="e3">★</label><!--
            --><input name="stars" id="e2" type="radio" value="2"></a><label for="e2">★</label><!--
            --><input name="stars" id="e1" type="radio" value="1"></a><label for="e1">★</label>
                </div><br>

                <?php
                if(isset($_POST['submit_comment']))
                {
                    $product->comments();
                }
                ?>

                <input type="submit" name="submit_comment" value="Laisser un avis">

            </form>

            <h1>Les avis des clients sur ce produit</h1><br><br>

            <?php
            /*foreach ($product->getComments() as $comments) { */?><!--
            commentaire :<br>  <?/*= $comments['comment'] */?><br>

            <img width="100px" src="../img/stars/<?/*= $comments['stars'] */?>.png"><br>
        --><?php /*}*/ ?>
        </article>
        <!-- /////// FIN Partie bottom ///////////-->

    <!--     FIN CONTAINER GENERAL       -->
    </div>
</main>

<footer>
</footer>
</body>
</html>

