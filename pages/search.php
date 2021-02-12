<?php
require_once '../class/produit_boutique.php';
require_once '../class/dataBase.php';
require_once '../class/panier.class.php';
require_once '../class/search.class.php';

session_start();

$product = new \db\Product();
$panier = new \db\Panier();
$search = new \db\Search();



if (isset($_GET['search']) and !empty($_GET['search'])) {
    $submit = true;
    $name = htmlspecialchars($_GET['search']);
    $results = $search->resultat_recherche($name);
}
?>

<form method="GET" action="search.php">
    <input type="search" name="search" size="100" placeholder="<?= $search->placeholders_article(); ?>"/>
    <input type="submit" value="Search"/>

</form>

<?php
if(isset($submit)) {
    $name = htmlspecialchars($_GET['search']);
    if(empty($name))
    {
        $make = '<h4>You must type a word to search!</h4>';

    }else{
        $make = '<h4>No match found!</h4>';
        $results = $search->resultat_recherche($name);

        if($row = $results->rowCount() > 0){
            while( $row = $results->fetch(\PDO::FETCH_ASSOC))
            {
                echo '<h4> Id : '.$row['id_produit'];
                echo '<br> name	: '.$row['titre'];
                echo '<br> Taille	: '.$row['taille'];
                echo '</h4>';

                echo "<a href='boutique_all.php?id=" . $row['id_produit'] . "'>Boutique</a>";


            }
        }else{
            echo'<h2> Search Result</h2>';

            print ($make);
        }

}
}


?>









