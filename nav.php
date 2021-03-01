<?php
require_once 'class/user.php';
require_once 'class/dataBase.php';
require_once 'class/admin.php';
require_once 'class/produit_boutique.php';
require_once 'class/panier.class.php';
require_once 'class/search.class.php';

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
            <a href="index.php">ACCUEIL</a><br><br><br>

            <a href="pages/boutique_all.php">TOUT LES PRODUITS</a><br><br>
            <a href="pages/boutique_all.php?id_category=34">Blousons | Manteaux</a><br><br>
            <a href="pages/boutique_all.php?id_category=35">Chemises | Surchemises</a><br><br>
            <a href="pages/boutique_all.php?id_category=36">Sweats | Pulls</a><br><br>
            <a href="pages/boutique_all.php?id_category=37">Jeans | Pantalon</a><br><br>
            <a href="pages/boutique_all.php?id_category=38">T-shirts | Polos</a><br><br>
        </nav>

    </div>

</div>

<div class="nav_bis">

    <div class="title">
        <a href="index.php"><img src="img/index/logo.png" class="title"></a>
    </div>

    <div >

        <article >

            <div class="search_icon">
                <a href="pages/search.php">RECHERCHER </a>
            </div>
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
            <?php }
        } else { ?>
            <a href="user/connexion.php">SE CONNECTER</a>
            <a href="#">PANIER</a>
        <?php } ?>


    </div>

</div>

</html>
