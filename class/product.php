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

        $error = '';


        $this->checkPicture();

//        $this->setPicture();
        $photo = $_POST['nameProd'] . "." . $this->extension;

        if (empty($error)) {
            $add = $this->query('INSERT INTO product(id_category, nom, description, prix, date, photo) VALUES(?,?,?,?,?,?) ',
                [$cat, $nameProd, $description, $prix, $date, $photo]);

            $idProduct = $this->lastInsertId();

            $arrayTaille = ['S', 'M', 'L', 'XL'];

            foreach ($arrayTaille as $taille) {
                if (empty($_POST[$taille])) {
                    $currentTaille = 0;
                } else {
                    $currentTaille = $_POST[$taille];
                }

                $this->query('INSERT INTO stock(id_product, taille, stock) VALUES(?,?,?) ', [$idProduct, $taille, $currentTaille]);
            }
        } else {
            echo $error;
        }


    }

    public function checkPicture()
    {
        $error = '';
        $extensionsValides = array('jpg', 'jpeg', 'png');
        $this->extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));

        if (in_array($this->extension, $extensionsValides)) {
            $chemin = "../img/imgboutique/" . $_POST['nameProd'] . "." . $this->extension;
            $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
        } else {
            $error = 'pas bon format';

        }

        return $error;

    }

    public function getAllProducts()
    {
        $response = $this->query('SELECT * FROM product INNER JOIN category WHERE product.id_category = category.id');
        return $response->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setProduct()
    {
        $this->product = $this->query('SELECT * FROM product WHERE id_product = ?', [$_GET['id']])->fetch(\PDO::FETCH_ASSOC);
        return $this;

    }

//    public function getSize()
//    {
//        return $this->query('SELECT * FROM stock WHERE id_product = ? ORDER BY taille', [$_GET['id']])->fetchAll(\PDO::FETCH_ASSOC);
//    }

    public function getSize()
    {
        return $this->query('SELECT * FROM stock WHERE id_product = ? ORDER BY taille', [$_GET['id']])->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getSizes()
    {
        return $this->query('SELECT * FROM stock WHERE id_product = ? ORDER BY taille', [$_GET['id']])->fetchAll(\PDO::FETCH_ASSOC);
    }


//    public function checkPicture()
//    {
//        $error = '';
//
//        if (isset($_FILES)) {
//            $extensionsValides = array('jpg', 'jpeg', 'png');
//            $this->extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
//
//            if (in_array($this->extension, $extensionsValides)) {
//                $chemin = "../img/imgboutique/" . $_POST['nameProd'] . "." . $this->extension;
//                $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
//            } else {
//                $error = 'photo pas bon format';
//
//            }
//        } else {
//            $error = 'photo manquante';
//
//        }


//        $error = '';
//
//
//        if ($extensionsValides) {
//            $this->extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
//            $chemin = "../img/imgboutique/" . $_POST['nameProd'] . "." . $this->extension;
//            $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
//        } else {
//            $error= 'non';
//        }
//
//        return $error;

//}

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


    public function updateProduct()
    {
        $productId = $_GET['id_product'];
        $date = $_POST['date'];
        $nproduit = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];

        $product = $this->query('SELECT * FROM product WHERE id_product = ?',
            [$productId,])->fetch(\PDO::FETCH_ASSOC);

//        if (!empty($_FILES)) {
//            $checkLog = $this->checkLogo();
//            $errors = [];
//            if (!empty($checkLog['error'])) {
//                $errors[] = $checkLog['error'];
//            }
//        }
        if (!empty($product) && empty($errors)) {
            $this->query('UPDATE product SET date = ?, nom = ?, description = ?,  prix = ?  WHERE id_product = ?', [
                $date,
                $nproduit,
                $description,
                $prix,
                $_GET['id_product']
            ]);
            foreach ($this->getSizes() as $size) {
                $currentSize = $_POST[$size->taille];
                $this->query('UPDATE stock set stock = ? WHERE id_product = ? AND taille = ? ', [
                    $currentSize,
                    $productId,
                    $size['taille']
                ]);
            }
//            if (!empty($_FILES)) {
//                $this->setLogo();
//            }
        }
        return [];
    }

}

