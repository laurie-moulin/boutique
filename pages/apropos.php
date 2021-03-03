<?php
require_once '../class/dataBase.php';
require_once '../class/location.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>A Propos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/googlemap.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&family=Fira+Sans:wght@300&family=Oswald:wght@300&family=PT+Sans+Narrow&family=Tajawal:wght@300&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/zoro.css"/>

</head>

<body>

<header>
    <?php

    include '../includes/nav.php';
    ?>
</header>

<main class="main_map">

    <div class="container_about">

        <article>
        <h1>About us</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ipsum erat, feugiat nec placerat in, gravida
            at est. Fusce ullamcorper, ligula sit amet pulvinar varius, est mauris bibendum justo, id elementum eros
            quam vel mauris. Duis ut sem sed risus porta gravida id rhoncus tellus. Quisque quis iaculis lectus. Aliquam
            sollicitudin sapien ex, ac hendrerit sem volutpat sit amet. Nulla varius auctor est eget posuere. In commodo
            imperdiet viverra.</p>
        </article><br>

        <article>
            <h1>Siège social</h1>
            <p>8 rue d'hozier <br> 13002 Marseille <br> 04.42.45.01.45</p><br><br>

            <a href="mailto:zoro@gmail.com">Nous contacter</a>
        </article>

    </div>

    <div class="container_map">

        <h1>Nos Magasins</h1>
        <?php

        $loc = new \db\location();
        $shop = $loc->getShopLatLng();
        $shop = json_encode($shop, true);
        echo '<div id="data">' . $shop . '</div>';

        $allData = $loc->getAllShop();
        $allData = json_encode($allData, true);
        echo '<div id="allData">' . $allData . '</div>';
        ?>
        <div id="map"></div>
    </div>

</main>

<footer>
    <?php
    include '../includes/footer.php';
    ?>
</footer>

</body>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSSVAHCX0WflgjfcLkpvs2hDCUNy9IKoQ&callback=loadMap">
</script>
</html>