<?php
namespace db;
require_once 'dataBase.php';

class product extends dataBase
{

    public function affichages_categories()
    {
      $cat = $this->query('SELECT * FROM category');
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

    //COMMANDES-ADRESSE
    public function affichages_adresse()
    {
        if (isset($_SESSION['id'])) {
            return $this->query('SELECT * FROM adresse WHERE id_users = ? ORDER BY adresse_id DESC LIMIT 0,1', [$_SESSION['id']])->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function set_adresses()
    {
        //if (isset($_SESSION['id'])) {
        return  $this->query('SELECT * FROM adresse WHERE id_users = ? ORDER BY adresse_id DESC LIMIT 0,1', [$_SESSION['id']])->fetch(\PDO::FETCH_ASSOC);
    //}
    }

    public function get_profil_commande()
    {
        return $this->query('SELECT adresse.adresse_id AS id_adresse, users.nom, users.prenom, email, adresse, telephone, code_postal, ville FROM users INNER JOIN adresse ON users.id = adresse.id_users WHERE users.id = ? ORDER BY adresse_id DESC LIMIT 0,1',[$_SESSION['id']])->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCommande() {
        return $this->query('SELECT * FROM commande WHERE id_users = ? ORDER BY id_commande DESC',[$_SESSION['id']])->fetchAll(\PDO::FETCH_ASSOC);
    }

   /* public function getCommande() {
        return $this->query('SELECT * FROM commande WHERE id_users = ? ORDER BY id_commande DESC',[$_SESSION['id']])->fetchAll(\PDO::FETCH_ASSOC);
    }*/

    public function detail_Commande($num_commande) {
        $sql = $this->query("SELECT  commande.montant, commande.id_commande, commande.date_enregistrement ,details_commande.quantité, details_commande.taille, details_commande.id_product, details_commande.prix AS prix_produit, quantité FROM commande INNER JOIN details_commande ON commande.id_commande = details_commande.id_commande WHERE commande.id_users = '".$_SESSION['id']."' AND commande.id_commande = '$num_commande'");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function prix_total($num_commande)
    {
        return $this->query('SELECT prix FROM commande WHERE id_commande = ?',[$num_commande])->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function comments()
    {
        $stars = htmlentities($_POST['stars']);
        $comment = htmlentities($_POST['comment']);

        if(!empty($stars) && !empty($comment)){
            return $this->query("INSERT INTO comment(id_product, stars, comment ) VALUES(?,?,?) ",
                [$_GET['id_product'], $stars, $comment]);
        }

    }

    public function getComments()
    {

        $comment = $this->query("SELECT * FROM comment WHERE id_product = '$_GET[id_product]'");
        return $comment->fetchAll(\PDO::FETCH_ASSOC);
    }

}


