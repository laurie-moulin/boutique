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
    <title>Utilisation de main</title>
    <link rel="stylesheet" href="../css/shop.css" />
</head>
<body>
<header>

    <nav>
        <a href="/"></a>
    </nav>
</header>
<main>
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
    <article>
        <form method="GET" action="search.php">
            <input type="search" name="search" size="100" placeholder="<?= $search->placeholders_article(); ?>"/>
            <input type="submit" value="Search"/>

        </form>
        <?php
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
                        echo '<h3> Id : '.$row['id_product'];
                        echo '<br> name	: '.$row['nom'];
                        echo '<br> Prix	: '.$row['prix'] . " euros";
                        echo '</h3>';
                        echo "<a href='detail_produit.php?id_product=" . $row['id_product'] . "'>Voir</a>";

                    }
                }else{
                    echo'<a href="boutique_all.php">Cliquer ici !</a> ';
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
