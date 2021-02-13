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


    public function insertcommande($id_users, $montant,$date_enregistrement)
    {
        $insert = $this->query('INSERT INTO commande (id_users, montant, date_enregistrement) VALUE( ?, ?, ?)', [$id_users, $montant,  $date_enregistrement]);

    }

    public function Last_id()
    {
       $stmt = $this->query("SELECT LAST_INSERT_ID()");
       return $stmt->fetchColumn();
    }

    public function insertcommandedetail($id_commande, $id_users, $id_produit, $quantite, $prix)
    {
        $insert = $this->query('INSERT INTO details_commande (id_commande,id_users, id_produit, quantité, prix) VALUE(?, ?, ?, ?, ?)', [$id_commande, $id_users, $id_produit, $quantite, $prix]);
    }
}
?>