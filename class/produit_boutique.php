<?php
namespace db;
require_once 'dataBase.php';

class product extends dataBase
{

    public function affichages_categories()
    {
      $cat = $this->query('SELECT id_category FROM product');
       return $cat->fetchAll();
    }


    public function affichages_des_produits()
    {
      $cat = $this->query("select id_product, nom, description, photo, prix, description  FROM  product where id_category ='$_GET[id_category]'");
       return $cat->fetchAll();
    }


    public function affichages_boutique()
        {
           $cat = $this->query('SELECT * FROM product');
           return $cat->fetchAll();
        }


        public function details_produit()
        {
           $cat = $this->query("SELECT * FROM product WHERE id_product = '$_GET[id_product]'");
           return $cat->fetch(\PDO::FETCH_ASSOC);
        }

    public function getSizes()
    {
        return $this->query('SELECT * FROM stock WHERE id_product = ? AND stock > 0 ORDER BY taille', [$_GET['id_product']])->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search()
    {
        $cat = $this->query("select id_product, nom, photo, prix, description  FROM  product where categorie ='$_GET[id_category]'");
        return $cat->fetchAll();
    }

}


