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

    public function UpdateStock($stock,$id_product,$taille)
    {
        return $update = $this->query('UPDATE stock SET stock = stock - ? WHERE id_product = ? and taille = ?', [$stock, $id_product, $taille]);

    }

    public function insertcommande($id_users, $montant,$date_enregistrement)
    {
        $insert = $this->query('INSERT INTO commande (id_users, montant, date_enregistrement) VALUE( ?, ?, ?)', [$id_users, $montant,  $date_enregistrement]);
        $lastid = $this->lastInsertId();
    }

    public function insertcommandedetail($lastID, $id_users, $id_product, $quantite, $prix, $size)
    {
        return $insert = $this->query('INSERT INTO details_commande (id_commande, id_users , id_product, quantité, prix, taille) VALUE(?, ?, ?, ?, ?, ?)', [$lastID, $id_users, $id_product, $quantite, $prix, $size]);
    }


}
?>