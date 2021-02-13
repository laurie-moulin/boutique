<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';

session_start();

$product = new \db\Product();
$panier = new \db\Panier();
$search = new \db\Search();





?>