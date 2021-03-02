<?php

namespace db;
require_once 'dataBase.php';


class faq extends dataBase
{
    public function faqMail(){

//        ini_set('SMTP','localhost');
//        ini_set('sendmail_from', 'laurie.moulin@live.fr');

        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header .= 'From: ' . $_POST['email'] . "\r\n";

        $message = '<h1>Message envoyé depuis la page Contact de Zoro</h1>
        <p><b>Nom Prénom: </b>' . $_POST['name'] . '<br>
        <b>Email : </b>' . $_POST['email'] . '<br>
        <b>Sujet : </b>' . $_POST['sujet'] . '<br>
        <b>Message : </b>' . $_POST['message'] . '</p>';

        $retour = mail('laurie.moulin@live.fr', 'Envoi depuis page Contact', $message, $header);
        if($retour) {
            echo '<p>Votre message a bien été envoyé.</p>';
        }
    }
}