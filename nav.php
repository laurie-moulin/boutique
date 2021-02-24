<?php
require_once 'class/user.php';
require_once 'class/dataBase.php';
require_once 'class/admin.php';

$admin = new \db\admin();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
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
        <img src="img/index/logo.png" class="title">
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
