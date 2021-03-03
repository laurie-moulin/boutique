<?php
namespace db;
require_once 'dataBase.php';
require 'location.php';
$loc = new \db\location();

$loc->setId($_REQUEST['id']);
$loc->setLat($_REQUEST['lat']);
$loc->setLng($_REQUEST['lng']);
$status = $loc->updateShopWithLatLng();
if($status == true) {
    echo "Updated...";
} else {
    echo "Failed...";
}
?>