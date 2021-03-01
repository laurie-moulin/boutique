<?php
require_once '../class/user.php';
require_once '../class/dataBase.php';
require_once '../class/admin.php';
require_once '../class/produit_boutique.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';

$admin = new \db\admin();
$product = new \db\product();
$panier = new \db\Panier();
$search = new \db\Search();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (isset($_GET['search']) and !empty($_GET['search'])) {
    $submit = true;
    $name = htmlspecialchars($_GET['search']);
    $results = $search->resultat_recherche($name);
}

?>

<html>

<div class="menu-container">

    <input type="checkbox" id="openmenu" class="hamburger-checkbox">

    <div class="hamburger-icon">
        <label for="openmenu" id="hamburger-label">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="menu-pane">

        <nav class="menu-links">

            <a href="###">Blousons | Manteaux</a><br><br>
            <a href="###">Chemises | Surchemises</a><br><br>
            <a href="###">Sweats | Pulls</a><br><br>
            <a href="###">Jeans | Pantalon</a><br><br>
            <a href="###">T-shirts | Polos</a><br><br>
        </nav>

    </div>

</div>

<div class="nav_bis">

    <div class="title">
        <img src="../img/index/logo.png" class="title">
    </div>

    <div class="main_search">
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
            <!--            <a href="pages/boutique_all.php" ><img src="img/cross.png"></a>-->
            <div>
                <form class="search" method="GET" action="nav.php">
                    <input type="search" name="search" size="100" placeholder="ÉCRIVEZ VOTRE RECHERCHE"/>
                    <button type="submit"><i class="fas fa-search"></i></button>
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
    </div>

    <div class="link_user">

        <?php
        if (isset($_SESSION['id'])) {
            if ($admin->isAllAdmin()) {

                ?>
                <a href="admin/admin_profil.php?id=<?= $_SESSION['id'] ?>">PROFIL</a>
                <a href="admin/deconnexion.php?>">DECONNEXION</a>
            <?php } else { ?>
                <a href="admin/deconnexion.php?>">DECONNEXION</a>
                <a href="user/profil.php?id=<?= $_SESSION['id'] ?>">PROFIL</a>
                <a href="#">PANIER</a>
            <?php } } else{ ?>
            <a href="user/connexion.php">SE CONNECTER</a>
            <a href="#">PANIER</a>
        <?php } ?>


    </div>

</div>

</html>
