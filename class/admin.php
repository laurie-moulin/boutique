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
            $isadmin = $this->query('SELECT * FROM users WHERE id = ?', [
                $_SESSION['id'],])->fetch(\PDO::FETCH_ASSOC);
            if (!empty($isadmin['admin']) && $isadmin['admin'] == 1) {
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

    public function addStatut()
    {
        $admin = $_POST['admin'];
        $this->query('INSERT INTO users (admin) VALUE(?)', [$admin]);
    }


}