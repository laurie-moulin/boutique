<?php
require_once '../class/user.php';
require_once '../class/dataBase.php';


if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
}

include ("../includes/nav_admin.php");

?>




