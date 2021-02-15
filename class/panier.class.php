<?php
namespace db;
require_once 'dataBase.php';

class Panier extends dataBase
{

    public function internauteEstConnecte()
    {
        if(!isset($_SESSION['membre'])) return false;
        else return true;
    }
    public function internauteEstConnecteEtEstAdmin()
    {
        if($this->internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) return true;
        else return false;
    }


    public function creationDuPanier()
    {
        if(isset($_SESSION["panier"]))
        {
            $item_array_id = array_column($_SESSION["panier"], "item_id");

            if(!in_array($_GET["id_product"], $item_array_id))
            {
                $count = count($_SESSION["panier"]);
                $item_array = array(
                    'item_id'		=>	$_GET["id_product"],
                    'item_name'		=>	$_POST["hidden_name"],
                    'item_price'		=>	$_POST["hidden_price"],
                    'item_quantity'		=>	$_POST["quantity"],
                    'item_size'		=>	$_POST["size"],
                    'item_photo'		=>	$_POST["hidden_photo"]
                );
                $_SESSION["panier"][$count] = $item_array;
            }
         else
            {
                echo '<script>alert("Article deja ajouté au panier avec la quantité .")</script>';
            }

        }
        else
        {
            $item_array = array(
                'item_id'		=>	$_GET["id_product"],
                'item_name'		=>	$_POST["hidden_name"],
                'item_price'		=>	$_POST["hidden_price"],
                'item_quantity'		=>	$_POST["quantity"],
                'item_size'		=>	$_POST["size"],
                'item_photo'		=>	$_POST["hidden_photo"]


            );
            $_SESSION["panier"][0] = $item_array;
        }
    }

    public function delete()
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["panier"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    unset($_SESSION["panier"][$keys]);
                    echo '<script>alert("Article retiré du panier")</script>';
                    echo '<script>window.location="panier.php"</script>';
                }
            }
        }
    }



}


?>