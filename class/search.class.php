<?php
namespace db;
require_once 'dataBase.php';

class Search extends dataBase
{

    function resultat_recherche($name)
    {
        $resultat = $this->query('SELECT nom, prix, id_product FROM product WHERE nom LIKE "%' . $name. '%" ORDER BY id_product DESC');
        if (empty($resultat )) {
            $resultat  = $this->query('SELECT nom, prix, id_product FROM product WHERE CONCAT(nom, description) LIKE "%' . $name . '%" ORDER BY id_product DESC');
        }
        return $resultat ;
    }


    function placeholders_article()
    {
        $placeholders = $this->query('SELECT nom FROM product ORDER BY id_product limit 2');
        foreach ($placeholders  as $holders) {
            echo $holders['nom'] . ' / ';
        }
}

}
?>
