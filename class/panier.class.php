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

    public function retirerProduitDuPanier($id_produit_a_supprimer)
    {
        $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
        if ($position_produit !== false)
        {
            array_splice($_SESSION['panier']['titre'], $position_produit, 1);
            array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
            array_splice($_SESSION['panier']['stock'], $position_produit, 1);
            array_splice($_SESSION['panier']['prix'], $position_produit, 1);
            array_splice($_SESSION['panier']['taille'], $position_produit, 1);
            array_splice($_SESSION['panier']['photo'], $position_produit, 1);
        }
    }
//------------------------------------
}

?>