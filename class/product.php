<?php

namespace db;
require_once 'dataBase.php';

class product extends dataBase
{
    protected $category = [];

    //CATEGORIES

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

    public function getCategory()
    {
        $getCateg = $this->query('SELECT * FROM category');
        return $getCateg->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setCategory()
    {

        $this->category = $this->query('SELECT * FROM category WHERE id = ?', [$_GET['id']])->fetch(\PDO::FETCH_ASSOC);
        return $this->category;
    }

    public function updateCategory()
    {
        $categoryUpdate = $_POST['categoryUpdate'];
        $this->query('UPDATE category SET categ_product = ? WHERE id = ?', [$categoryUpdate, $_GET['id']]);
        return [];
    }

    public function deleteCategory()
    {
        $this->query('DELETE FROM category WHERE id = ?', [$_GET['id']]);
        return [];
    }

    //PRODUITS



}