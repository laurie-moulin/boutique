<?php
namespace db;
require_once 'dataBase.php';

class location extends dataBase
{

    private $id;
    private $name;
    private $address;
    private $type;
    private $lat;
    private $lng;
    private $conn;
    private $tableName = "location";

    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setName($name) { $this->name = $name; }
    function getName() { return $this->name; }
    function setAddress($address) { $this->address = $address; }
    function getAddress() { return $this->address; }
    function setType($type) { $this->type = $type; }
    function getType() { return $this->type; }
    function setLat($lat) { $this->lat = $lat; }
    function getLat() { return $this->lat; }
    function setLng($lng) { $this->lng = $lng; }
    function getLng() { return $this->lng; }


    public function getShopLatLng() {
        $sql = $this->query("SELECT * FROM $this->tableName WHERE lat IS NULL AND lng IS NULL");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllShop() {
        $sql = "SELECT * FROM $this->tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateShopWithLatLng() {
        $sql = "UPDATE $this->tableName SET lat = :lat, lng = :lng WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':lat', $this->lat);
        $stmt->bindParam(':lng', $this->lng);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}