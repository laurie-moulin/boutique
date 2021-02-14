<?php
namespace db;
require_once 'dataBase.php';

class Commands extends dataBase
{


    public function montant()
    {
        if(!empty($_SESSION["panier"]))
        {
            $total = 0;
            foreach($_SESSION["panier"] as $keys => $values)
            {
                number_format($values["item_quantity"] * $values["item_price"], 2);
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
        }
        return number_format($total, 2);
    }


  /*  public function insertcommande($id_users, $montant,$date_enregistrement,$id_produit, $quantite, $prix, $size)
    {
        $insert = $this->query('INSERT INTO commande (id_users, montant, date_enregistrement) VALUE( ?, ?, ?)', [$id_users, $montant,  $date_enregistrement]);
        $lastID = $this->lastInsertId();
        $insert = $this->query('INSERT INTO details_commande (id_commande,id_users, id_produit, quantité, prix, taille) VALUE(?, ?, ?, ?, ?, ?)', [$this->lastInsertId(), $id_users, $id_produit, $quantite, $prix, $size]);

    }*/




    public function UpdateStock($stock, $id_produit,$taille)
    {
        return $update = $this->query('UPDATE stock SET stock = stock - ? WHERE id_produit = ? and taille = ?', [$stock, $id_produit, $taille]);

    }

    public function insertcommande($id_users, $montant,$date_enregistrement)
    {
        return $insert = $this->query('INSERT INTO commande (id_users, montant, date_enregistrement) VALUE( ?, ?, ?)', [$id_users, $montant,  $date_enregistrement]);

    }
    public function selectidcommand()
    {
        $cat = $this->query('SELECT id_commande FROM details_commande');
        return $lastID = $cat->rowCount();
    }

    public function insertcommandedetail($lastID, $id_users, $id_produit, $quantite, $prix, $size)
    {
       return  $insert = $this->query('INSERT INTO details_commande (id_commande,id_users, id_produit, quantité, prix, taille) VALUE(?, ?, ?, ?, ?, ?)', [$this->lastInsertId(), $id_users, $id_produit, $quantite, $prix, $size]);

    }
}
?>