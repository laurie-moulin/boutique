<?php
namespace db;
require_once 'dataBase.php';

class Panier extends dataBase
{
    public function supprimer_produit($key){
        # Retire un produit de la liste
        unset($_SESSION['panier'][$key]);
    }


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
        if(!isset($_SESSION['panier']))
        {
          $_SESSION['panier'] = [];
            $_SESSION['panier']['titre'] = [];
            $_SESSION['panier']['id_produit'] = [];
            $_SESSION['panier']['stock'] = [];
            $_SESSION['panier']['taille'] = [];
            $_SESSION['panier']['prix'] = [];
            $_SESSION['panier']['photo'] = [];
        }
        return true;
    }

    public function ajouterProduitDansPanier($id_produit, $titre, $stock, $prix, $taille,$photo)
    {
        $this->creationDuPanier();
         //$position_produit = array_search($id_produit,$_SESSION['panier']['id_produit']);
         //$position_produit = $_SESSION['panier']['id_produit'];

            $_SESSION['panier']['titre'][] = $titre;
            $_SESSION['panier']['id_produit'][] = $id_produit;
            $_SESSION['panier']['stock'][] = $stock;
            $_SESSION['panier']['prix'][] = $prix;
            $_SESSION['panier']['taille'][] = $taille;
            $_SESSION['panier']['photo'][] = $photo;

    }

 public function montantTotal()
    {
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            $total += $_SESSION['panier']['stock'][$i] * $_SESSION['panier']['prix'][$i];
        }
        return round($total,2);
    }

    /*SUPPRIME UN ARTICLE DU PANIER*/
    function deleteProduct($position)
    {
        $_SESSION['panier'][$position];
        array_splice($_SESSION['panier'], $position, 1);
        $this->montantTotal();
    }


    /*function supprimerArticle($libelleProduit){
        //Si le panier existe
        if ($this->creationDuPanier())
        {
            //Nous allons passer par un panier temporaire
            $tmp = [];
            $tmp['titre'] = [];
            $tmp['id_produit'] = [];
            $tmp['stock'] = [];
            $tmp['taille'] = [];
            $tmp['prix'] = [];
            $tmp['photo'] = [];

            for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
            {
                if ($_SESSION['panier']['id_produit'][$i] !== $libelleProduit)
                {
                    array_push( $tmp['titre'],$_SESSION['panier']['titre'][$i]);
                    array_push( $tmp['id_produit'],$_SESSION['panier']['id_produit'][$i]);
                    array_push( $tmp['stock'],$_SESSION['panier']['stock'][$i]);
                    array_push( $tmp['taille'],$_SESSION['panier']['taille'][$i]);
                    array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
                    array_push( $tmp['photo'],$_SESSION['panier']['photo'][$i]);
                }

            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] =  $tmp;
            //On efface notre panier temporaire
            unset($tmp);
        }
        else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }*/

/*
   public function montantTotal($id_produit, $stock, $prix)
       {
           $total=0;
           for($i = 0; $i < count([$id_produit]); $i++)
           {
               $total += ($stock[$i]) * ($prix[$i]);
           }
           return round($total,2);
       }*/



  public function retirerProduitDuPanier($id_produit_a_supprimer)
    {


        $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
        if ($position_produit !== false)
        {
            array_splice($_SESSION['panier']['titre'], $id_produit_a_supprimer, 1);
            array_splice($_SESSION['panier']['id_produit'], $id_produit_a_supprimer, 1);
            array_splice($_SESSION['panier']['stock'], $id_produit_a_supprimer, 1);
            array_splice($_SESSION['panier']['prix'], $id_produit_a_supprimer, 1);
            array_splice($_SESSION['panier']['taille'], $id_produit_a_supprimer, 1);
            array_splice($_SESSION['panier']['photo'], $id_produit_a_supprimer, 1);

        }
    }

    public function test()
    {
        $testta = $_SESSION['panier']['id_produit'];
        $testta = implode( ',', $testta );


        $cat = $this->query("SELECT * FROM produit WHERE id_produit=" . $testta);
            return $cat->fetch(\PDO::FETCH_ASSOC);



    }
}


?>