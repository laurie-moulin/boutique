<?php

namespace db;
require_once 'dataBase.php';

class product extends dataBase
{
    private $id;

    public function affichages_categories()
    {
      $cat = $this->query('SELECT categorie FROM produit');
       return $cat->fetchAll();
    }


    public function affichages_des_produits()
    {
      $cat = $this->query("select id_produit, titre, photo, prix, description  FROM  produit where categorie ='$_GET[categorie]'");
       return $cat->fetchAll();
    }


    public function affichages_boutique()
        {
           $cat = $this->query('SELECT * FROM produit');
           return $cat->fetchAll();
        }


        public function details_produit()
        {
           $cat = $this->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
           return $cat->fetch(\PDO::FETCH_ASSOC);
        }


        public function panier_produit()
        {
           $cat = $this->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
           return $cat->fetch(\PDO::FETCH_ASSOC);
        }




        public function sizes_produit()
        {
            $sizes = $this->query("SELECT * FROM sizes");
            return $sizes->fetch(\PDO::FETCH_ASSOC);
        }
         public function stock_produit()
         {
             $stock = $this->query("SELECT * FROM stock WHERE id_produit = '$_GET[id_produit]'");
             return $stock->fetch(\PDO::FETCH_ASSOC);
         }

    public function getSizes()
    {
        return $this->query('SELECT * FROM stock WHERE id_produit = ? AND stock > 0 ORDER BY taille', [$_GET['id_produit']])->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function get_id_produit()
    {
        return $this->id;
    }

}


