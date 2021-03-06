<?php


namespace db;
require_once 'dataBase.php';
require 'message.php';
require_once 'user.php';

class admin extends dataBase
{

    public function getStatut($email)
    {
        $admin = $this->query('SELECT admin FROM users WHERE email = ?', [$email])->fetch(\PDO::FETCH_ASSOC);
        return $admin;
    }

    public function isAdmin()
    {
        if (empty($_SESSION['id'])) {
            echo '';
        }
        if (isset($_SESSION)) {
            $isadmin = $this->query('SELECT * FROM users WHERE id = ?', [$_SESSION['id'],])->fetch(\PDO::FETCH_ASSOC);
            if (!empty($isadmin['admin']) && $isadmin['admin'] == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function isAllAdmin()
    {
        if (empty($_SESSION['id'])) {
            echo '';
        }
        if (isset($_SESSION)) {
            $isalladmin = $this->query('SELECT * FROM users WHERE id = ?', [$_SESSION['id'],])->fetch(\PDO::FETCH_ASSOC);
            if (!empty($isalladmin['admin']) && $isalladmin['admin'] >= 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getAdmin()
    {
        $getAdmin = $this->query('SELECT * FROM users WHERE admin >= 1');
        return $getAdmin->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUsers()
    {
        $getUsers = $this->query('SELECT * FROM users WHERE admin = 0');
        return $getUsers->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteUser()
    {
        $this->query('DELETE FROM users WHERE id = ?', [$_GET['id']]);
        return [];
    }

    public function setUser()
    {

        $this->user = $this->query('SELECT * FROM users WHERE id = ?', [$_GET['id']])->fetch(\PDO::FETCH_ASSOC);
        return $this->user;
    }

    public function addAdmin()
    {

        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $email = htmlentities($_POST['email']);
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
        $admin = $_POST['admin'];


//VERIFICATION EXISTENCE USER
        $userExist = $this->query('SELECT * FROM users WHERE email = ?', [$email])->rowCount();
        if ($userExist == 1) {
            $errors[] = 'l\'adresse mail est d??j?? utilis??e.';
        }

//VERIFICATION PASSWORD (CARACTERE & CORRESPONDANCE)
//        $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $password);
//        if (!$password_required) {
//            $errors[] = "Le mot de passe doit contenir: Entre 8 et 20 caract??res avec au moins 1 caract??re sp??cial, 1 majuscule, 1 minuscule et un chiffre.";
//        }

        if ($password != $confpassword) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 15));
        }

        if (empty($errors)) {
            $this->query('INSERT INTO users (prenom, nom, email, password, admin) VALUE(?, ?, ?, ?, ?)',
                [$prenom, $nom, $email, $password, $admin]);
//            header('location: connexion.php');
        } else {
            $message = new messages($errors);
            echo $message->renderMessage();
        }

    }

    public function connectAdmin(){
        $email = htmlentities($_POST['email']);
        $password = $_POST['password'];

        $user = $this->query('SELECT * FROM users WHERE email = ? ', [$email])->fetch(\PDO::FETCH_ASSOC);
        if (empty($user)) {
            $errors[] = "Adresse mail inexistante";
        }
        
        //VERIF MDP
        if (!empty($user) && !password_verify($password, $user['password'])) {
            $errors[] = "mauvais mdp";
        }

        $admin = new admin();
        $statut = $admin->getStatut($email);

        if ($statut['admin'] == 0) {
            $errors[] = "Acc??s refus??";
        }

        if(empty($errors) && $statut['admin'] >= 1 )
        {
            $this->id = $user['id'];
            $_SESSION['id'] = $user['id'];
            header("location:admin_profil.php?id=" . $_SESSION['id']);
        }
        else{
            $message = new messages($errors);
            echo $message->renderMessage();
        }
    }

    public function getNews()
    {
        $newsletter = $this->query('SELECT * FROM newsletter')->fetchAll(\PDO::FETCH_ASSOC);
        return $newsletter;
    }


}