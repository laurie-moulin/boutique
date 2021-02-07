<?php

namespace db;

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

/*class Db{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'boutique';
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null){
        if($host != null){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ));
        }catch(PDOException $e){
            die('<h1>Impossible de se connecter a la base de donnee</h1>');
        }


    }
    public function query($sql, $data = [])
    {
        $req =$this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}*/

?>

