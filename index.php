<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;

//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;
//nombre de film par page
$num = 100;

//numéro de page
$page = 1;

//offset par défaut
$offset = 0;

//écrasée par celui de l'URL si get['page'] n'est pas vide
if (!empty($_GET['page'])){
    $page = $_GET['page'];
    $offset = $page * $num - $num;
}
//inclus les paramètres d'offset pour la pagination
$sql = "SELECT * FROM movies_full
ORDER BY RAND()
 LIMIT $num 
 OFFSET $offset ";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

//requête pour compter le nombre de lignes dans la table
$sql = "SELECT COUNT(*) FROM movies_full";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$count = $stmt->fetchColumn();

include ('inc/header.php');

?>
<?php
paginationIdea($page,$num,$count);
foreach ($movies as $movie) {
    ;
    ; ?>

    <h1>Titre : <?= $movie['title']; ?></h1>

    <img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?= $movie['title']; ?>">


<?php }
paginationIdea($page,$num,$count);?>




<?php
include('inc/footer.php');
