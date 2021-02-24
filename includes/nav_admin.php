<?php

require_once '../class/admin.php';
require_once '../class/dataBase.php';

$admin = new \db\admin();



if ($admin->isAdmin()) {
    echo '

<div class="beginNav">
<div><a href="../index.php"><img src="../img/index/logo.png" width="10%"></a></div>
<div><h1>Espace Administrateur</h1></div>
<div><a href="../admin/deconnexion.php">Déconnexion</a></div>
</div>

<nav class="navAdmin">
    <a href="../admin/admin_profil.php?id='. $_SESSION['id'] .' ">Profil</a>
    <a href="../admin/admin_gestionadmin.php">Gestion admin</a>
    <a href="../admin/admin_gestionusers.php">Gestion users</a>
    <a href="../admin/admin_product.php">Produits</a>
    <a href="../admin/admin_addProd.php">Ajouter produit</a>
    <a href="../admin/admin_category.php">Catégories</a>
    <a href="../admin/admin_newsletter.php">Newsletter</a>

</nav>';
} else {
    echo '<nav class="navAdmin">
    <a href="../admin/admin_profil.php?id='. $_SESSION['id'] .' ">Admin</a>
    <a href="../admin/admin_product.php">Produits</a>
    <a href="../admin/admin_addProd.php">Ajouter produit</a>
    <a href="../admin/admin_category.php">Catégories</a>
     <a href="../admin/admin_newsletter.php">Newsletter</a>

</nav>';
}












