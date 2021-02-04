<?php

namespace db;
require_once 'dataBase.php';

class product extends dataBase
{

    protected $category = [];

    function addCategory()
    {
        $categoryName = htmlentities($_POST['add_categ']);

        //Verification existence de la catégorie en bdd
        $existCateg = $this->query('SELECT * FROM category WHERE categ_product = ?', [$categoryName])->rowCount();

        if($existCateg == 0){
            $this->query("INSERT INTO category(categ_product) VALUE(?)", [$categoryName]);
        }
        else{
            echo 'catégorie déjà existante';
        }


        return ['value' => $categoryName];


    }


}