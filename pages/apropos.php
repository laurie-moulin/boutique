
<!DOCTYPE html>
<html>
<head>
    <title>Access Google Maps API in PHP</title>
<!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/googlemap.js"></script>
    <style type="text/css">
        .container {
            height: 400px;
            width: 50%;
        }
        #map {
            width: 100%;
            height: 100%;
            border: 1px solid blue;
        }
        #data, #allData {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>A Propos</h1>
    <?php
    require '../class/location.php';
    $loc = new db\location;
    $shop = $loc->getShopLatLng();
    $shop = json_encode($shop, true);
    echo '<div id="data">' . $shop . '</div>';

//    $allData = $edu->getAllColleges();
//    $allData = json_encode($allData, true);
//    echo '<div id="allData">' . $allData . '</div>';
    ?>
    <div id="map"></div>
</div>
</body>
<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSSVAHCX0WflgjfcLkpvs2hDCUNy9IKoQ&callback=loadMap">
</script>
</html>