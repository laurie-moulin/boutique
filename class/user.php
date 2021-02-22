<?php

namespace db;
require_once 'dataBase.php';
//require 'message.php';
require_once 'admin.php';

class user extends dataBase
{
    private $id;

    public function register()
    {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $email = htmlentities($_POST['email']);
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];


//VERIFICATION EXISTENCE USER
        $userExist = $this->query('SELECT * FROM users WHERE email = ?', [$email])->rowCount();
        if ($userExist == 1) {
            $errors[] = 'l\'adresse mail est déjà utilisée.';
        }

//VERIFICATION PASSWORD (CARACTERE & CORRESPONDANCE)
        $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $password);
        if (!$password_required) {
            $errors[] = "Le mot de passe doit contenir: Entre 8 et 20 caractères avec au moins 1 caractère spécial, 1 majuscule, 1 minuscule et un chiffre.";
        }

        if ($password != $confpassword) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 15));
        }

        if (empty($errors)) {
            $this->query('INSERT INTO users (prenom, nom, email, password) VALUE(?, ?, ?, ?)',
                [$prenom, $nom, $email, $password]);
//            header('location: connexion.php');
        } else {
            $message = new messages($errors);
            echo $message->renderMessage();
        }

    }

    public function connect()
    {
        $email = htmlentities($_POST['email']);
        $password = $_POST['password'];


        //VERIFICATION EXISTANCE MAIL
        $user = $this->query('SELECT * FROM users WHERE email = ? ', [$email])->fetch(\PDO::FETCH_ASSOC);
        if (empty($user)) {
            $errors[] = "Adresse mail inexistante";
        }

        //VERIF MDP
        if (!empty($user) && !password_verify($password, $user['password'])) {
            $errors[] = "mauvais mdp";
        }

        //METHODE POUR TROUVER LE STATUT DE LA PERSONNE
        $admin = new admin();
        $statut = $admin->getStatut($email);

        if (empty($errors) && $statut['admin'] >= 1) {
            $this->id = $user['id'];
            $_SESSION['id'] = $user['id'];
            header("location:../admin/admin_profil.php?id=" . $_SESSION['id']);
        } elseif (empty($errors) && $statut['admin'] == 0) {
            $this->id = $user['id'];
            $_SESSION['id'] = $user['id'];
            header("location:profil.php?id=" . $_SESSION['id']);
        } elseif (isset($errors)) {
            $message = new messages($errors);
            echo $message->renderMessage();
        }

    }

    public function update()
    {

        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $email = htmlentities($_POST['email']);
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];

        $userId = $_GET['id'];
        $user = $this->query('SELECT * FROM users WHERE id = ? AND id = ?',
            [$_SESSION['id'], $userId])->fetch(\PDO::FETCH_ASSOC);


    //VERIFICATION EXISTENCE USER
        $userExist = $this->query('SELECT * FROM users WHERE email = ?', [$email])->rowCount();
        if ($userExist == 1 and $userExist != $email) {
            $errors[] = 'l\'adresse mail est déjà utilisée.';
        }

    //VERIFICATION PASSWORD (CARACTERE & CORRESPONDANCE)
        $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $password);
        if (!$password_required) {
            $errors[] = "Le mot de passe doit contenir: Entre 8 et 20 caractères avec au moins 1 caractère spécial, 1 majuscule, 1 minuscule et un chiffre.";
        }

        if ($password != $confpassword) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 15));
        }


        if (empty($errors)) {
            $this->query('UPDATE users SET email = ?, nom = ?, prenom = ?, password = ? WHERE id = ?',
                [$email, $nom, $prenom, $password, $userId]);
        } else {
            $message = new messages($errors);
            echo $message->renderMessage();
        }
    }

    public function newsletter()
    {

        $email = htmlentities($_POST['email']);
        $userExist = $this->query('SELECT * FROM newsletter WHERE email_news = ?', [$email])->rowCount();
        if ($userExist == 1) {
            $errors[] = 'Vous êtes déjà inscris à la newsletter';
        }

        if(empty($errors)){
            $this->query('INSERT INTO newsletter (email_news) VALUE(?)',
                [$email]);
        }
        else {
            $message = new messages($errors);
            echo $message->renderMessage();
        }

    }


}
