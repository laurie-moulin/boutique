<?php

namespace db;

session_start();

class dataBase{

    protected $pdo = null;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=boutique', 'root', '' );

    }

    public function query($request, array $args = [])
    {
        if(!empty($args)){
            $statement =  $this->pdo->prepare($request);
            $statement->execute($args);
        } else {
            $statement = $this->pdo->query($request);
        }

        return $statement ;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


}
