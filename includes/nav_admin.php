<?php

require_once '../class/admin.php';
require_once '../class/dataBase.php';

$admin = new \db\admin();

if ($admin->isAdmin()) {
    echo '<nav>
    <a href="../admin/admin_profil.php?id='. $_SESSION['id'] .' ">Admin</a>
    <a href="../admin/admin_gestionadmin.php">Gestion admin</a>
    <a href="../admin/admin_gestionusers.php">Gestion users</a>
    <a href="../admin/admin_product.php">Produits</a>
    <a href="../admin/admin_addProd.php">Ajouter produit</a>
    <a href="../admin/admin_category.php">Catégories</a>

</nav>';
} else {
    echo '<nav>
    <a href="../admin/admin.php">Admin</a>
    <a href="../admin/admin_product.php">Produits</a>
    <a href="../admin/admin_addProd.php">Ajouter produit</a>
    <a href="../admin/admin_category.php">Catégories</a>

</nav>';
}












