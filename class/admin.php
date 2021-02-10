<?php


namespace db;
require_once 'dataBase.php';

class admin extends dataBase{

    public function getStatut($email){
        $admin = $this->query('SELECT admin FROM users WHERE email = ?', [$email])->fetch(\PDO::FETCH_ASSOC);
        return $admin;
    }


}