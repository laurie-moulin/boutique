<?php
namespace db;
require_once 'dataBase.php';

class Panier extends dataBase
{

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
                echo "<a class='panier3_achat' href='../pages/boutique_all.php'><span >ARTICLE DEJA AJOUTÉ AVEC LA QUANTITÉ !</span></a>";
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
                    //unset($_SESSION["icon_shop"]);
                    echo "<span class='panier3_achat'>ARTICLE RETIRÉ DU PANIER</span>";
                }
            }
        }
    }


    public function creation_shop_icon()
    {
              if(!isset($_SESSION["icon_shop"]))
              {
                  $_SESSION["icon_shop"] = 0;
              }
              if(isset($_SESSION["icon_shop"]))
              {
                  $_SESSION["icon_shop"] = $_SESSION["icon_shop"] +1;
              }

    }

}


?>