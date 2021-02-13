<?php
namespace db;
require_once 'dataBase.php';

class Search extends dataBase
{


    function resultat_recherche($name)
    {
        $resultat = $this->query('SELECT titre, taille, id_produit FROM produit WHERE titre LIKE "%' . $name. '%" ORDER BY id_produit DESC');
        if (empty($resultat )) {
            $resultat  = $this->query('SELECT titre, taille, id_produit FROM produit WHERE CONCAT(titre, description) LIKE "%' . $name . '%" ORDER BY id_produit DESC');
        }
        return $resultat ;
    }


    function placeholders_article()
    {
        $placeholders = $this->query('SELECT titre FROM produit ORDER BY id_produit');
        foreach ($placeholders  as $holders) {
            echo $holders['titre'] . ' / ';
        }
}

}
?>
