<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';

session_start();

$product = new \db\Product();
$panier = new \db\Panier();
$search = new \db\Search();





?>

HTML CODE
<div class="container">
    <input type="button" onclick="decrementValue()" value="-" />
    <input type="text" name="quantity" value="1" maxlength="2" max="10" size="1" id="number" />
    <input type="button" onclick="incrementValue()" value="+" />
</div>

JAVA SCRIPT
<script type="text/javascript">
    function incrementValue()
    {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<10){
            value++;
            document.getElementById('number').value = value;
        }
    }
    function decrementValue()
    {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            document.getElementById('number').value = value;
        }

    }
</script>
