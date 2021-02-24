<?php
    session_start();
 
    if (isset($_SESSION['id'])) { // Si tu es connecté on te déconnecte et on te redirige vers une page.

        $_SESSION = array();
        session_destroy();

        header('Location: ../index.php');
 
    }


?>