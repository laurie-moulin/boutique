<?php
namespace db;
require_once 'dataBase.php';

class Panier extends dataBase
{
    public function __construct()
    {
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
    }

    public function add_panier()
    {
        $cat = $this->query("SELECT id_produit FROM produit WHERE id_produit = '$_GET[id_produit]'");
        return $cat->fetch(\PDO::FETCH_ASSOC);
    }



    public function add($id_produit)
    {
        $_SESSION['panier']['id_produit'] = 1;
    }
}


?>