<?php
require_once '../class/dataBase.php';
require_once '../class/faq.php';




?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/zoro.css">
    <title>FAQ</title>
</head>

<body>

<header>
    <?php

    include '../includes/nav.php';

    ?>
</header>

<main class="main_faq">

    <section class="sectionfaq" >
        <h1 class="question">Pourquoi est-ce que je ne trouve soudainement plus un certain article?</h1>
        <article class="reponse">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis nisi facilisis dui molestie dignissim. Integer vel odio eget quam faucibus ultricies. Etiam eu libero maximus, pretium neque non, volutpat felis. Pellentesque sit amet orci consectetur, pulvinar nunc id, volutpat leo.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis nisi facilisis dui molestie dignissim. Integer vel odio eget quam faucibus ultricies. Etiam eu libero maximus, pretium neque non, volutpat felis. Pellentesque sit amet orci consectetur, pulvinar nunc id, volutpat leo.
        </article>

    </section>


    <section class="sectionfaq">
        <h1 class="question">Livrez-vous également à l’étranger?</h1>
        <article class="reponse">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis nisi facilisis dui molestie dignissim. Integer vel odio eget quam faucibus ultricies. Etiam eu libero maximus, pretium neque non, volutpat felis. Pellentesque sit amet orci consectetur, pulvinar nunc id, volutpat leo.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis nisi facilisis dui molestie dignissim. Integer vel odio eget quam faucibus ultricies. Etiam eu libero maximus, pretium neque non, volutpat felis. Pellentesque sit amet orci consectetur, pulvinar nunc id, volutpat leo.
        </article>

    </section>


    <section class="sectionfaq">
        <h1 class="question">Le paiement en ligne est-il sécurisé?</h1>
        <article class="reponse">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis nisi facilisis dui molestie dignissim. Integer vel odio eget quam faucibus ultricies. Etiam eu libero maximus, pretium neque non, volutpat felis. Pellentesque sit amet orci consectetur, pulvinar nunc id, volutpat leo.
        </article>


    </section>

    <section class="sectionfaq">
        <h1 class="question">À combien s’élèvent les frais d’expédition?</h1>
        <article class="reponse">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lobortis nisi facilisis dui molestie dignissim. Integer vel odio eget quam faucibus ultricies. Etiam eu libero maximus, pretium neque non, volutpat felis. Pellentesque sit amet orci consectetur, pulvinar nunc id, volutpat leo.
        </article>

    </section><br><br>

    <section class="sectionfaq">

        <h1>Vous avez une autre question? Envoyez nous un message juste ici ! </h1>

    <form method="post" action="faq.php" class="formfaq">

        <input type="text" name="name" placeholder="Nom et Prénom" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="sujet" placeholder="Sujet" required><br>
        <textarea name="message" placeholder="Votre message !" rows="10" cols="60" required></textarea><br>

        <button name="submit">Envoyer</button>

        <?php

        if(isset($_POST['submit']))
        {
            $faq = new \db\faq();
            $faq->faqMail();

        }

        ?>

    </form>

    </section>


</main>


</body>
</html>