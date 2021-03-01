<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';



$product = new \db\Product();
$panier = new \db\Panier();
$search = new \db\Search();



if (isset($_GET['search']) and !empty($_GET['search'])) {
    $submit = true;
    $name = htmlspecialchars($_GET['search']);
    $results = $search->resultat_recherche($name);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../img/logovignette-100.jpg" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <title>Boutique</title>
    <link rel="stylesheet" href="../css/shop.css" />
</head>
<body class="body_search">
<header>

    <nav>
        <a href="/"></a>
    </nav>
</header>
<main class="main_Search">

    <article>
        <?php
        if(isset($_SESSION["icon_shop"]))
        {
            echo "<div class='test'>";
            echo  $_SESSION["icon_shop"] ;
            echo "</div>";
        }
        ?>
    </article>
    <article class="cross_flex">
        <a href="boutique_all.php" ><img src="../img/cross.png"></a>
        <div class="container_formsearch">
            <form class="search" method="GET" action="search.php">
                <input class="inputsearch" type="search" name="search" placeholder="ÉCRIVEZ VOTRE RECHERCHE"/>
                <input type="submit" value="Cherche"/>
            </form>
        </div>
    </article>
    <article>
        <?php
        //$search->placeholders_article();
        if(isset($submit)) {
            $name = htmlspecialchars($_GET['search']);
            if(empty($name))
            {
                $make = '<h1>Vous devriez taper un mot pour rechercher!</h1>';

            }else{
                $make = '<h2>Pas de résultats!</h2>';
                $results = $search->resultat_recherche($name);

                if($row = $results->rowCount() > 0){
                    while( $row = $results->fetch(\PDO::FETCH_ASSOC))
                    {
                        echo '<h3> RÉFERENCE : '.$row['id_product'];
                        echo '<br> NOM	: '.$row['nom'];
                        echo '<br> PRIX	: '.$row['prix'] . " EUR";
                        echo '</h3>';
                        echo "<a class='lonk_search' href='detail_produit.php?id_product=" . $row['id_product'] . "'>VOIR</a>";

                    }
                }else{
                    echo'<a class="lonk_search" href="boutique_all.php">CLIQUER ICI !</a> ';
                    print ($make);
                }
            }
        }
        ?>
    </article>
</main>
<footer></footer>
</body>
</html>