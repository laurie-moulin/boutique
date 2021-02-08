<?php

namespace db;
require_once 'dataBase.php';

class product extends dataBase
{
    protected $category = [];
    protected $extensionType = ['.png', '.jpeg', '.jpg'];

    //CATEGORIES

    function addCategory()
    {
        $categoryName = htmlentities($_POST['add_categ']);

        //Verification existence de la catégorie en bdd
        $existCateg = $this->query('SELECT * FROM category WHERE categ_product = ?', [$categoryName])->rowCount();

        if ($existCateg == 0) {
            $this->query("INSERT INTO category(categ_product) VALUE(?)", [$categoryName]);

        } else {
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

    public function addProduct()
    {

        $date = htmlentities($_POST['date']);
        $cat = htmlentities($_POST['category']);
        $nameProd = htmlentities($_POST['nameProd']);
        $description = htmlentities($_POST['description']);
        $prix = htmlentities($_POST['prix']);

        $extensionsValides = array('jpg', 'jpeg', 'png');

        if($extensionsValides){
            $this->extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
            $chemin = "../img/imgboutique/".$_POST['nameProd'] .".".$this->extension;
            $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
        }
        else{
            echo non;
        }

        $photo= $_POST['nameProd'] .".".$this->extension;

//        $this->checkPicture();
//        $this->setPicture();


        $add = $this->query('INSERT INTO product(id_category, nom, description, prix, date, photo) VALUES(?,?,?,?,?,?) ', [
            $cat, $nameProd, $description, $prix, $date, $photo]);

        $idProduct = $this->lastInsertId();

        $arrayTaille = ['S', 'M', 'L', 'XL'];

        foreach ($arrayTaille as $taille) {
            if (empty($_POST[$taille])) {
                $currentTaille = 0;
            } else {
                $currentTaille = $_POST[$taille];
            }

            $this->query('INSERT INTO stock(id_product, taille, stock) VALUES(?,?,?) ', [ $idProduct, $taille, $currentTaille]);
        }


    }

//    public function checkPicture(){
//
//        $type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
//        $output = [
//            'type' => $type
//        ];
//        if (!in_array("." . $type, $this->extensionType)) {
//            echo "Format d'image autorisé: " . implode(", ", $this->extensionType);
//        }
//        return $output;
//    }

//    public function setPicture()
//    {
//
//        $extensionsValides = array('jpg', 'jpeg', 'png');
//
//        if($extensionsValides){
//            $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
//            $chemin = "../img/imgboutique/".$_POST['nameProd'] .".".$extensionUpload;
//            $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
//        }
//        else{
//            echo non;
//        }


    }




}