<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;

//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;

$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
$limite = 100;
$offset = ($page - 1) * $limite;
$sql = "SELECT * FROM movies_full
ORDER BY RAND()
 LIMIT $limite 
 OFFSET $offset ";
$query = $pdo->prepare($sql);

$query->execute();
$movies = $query->fetchAll();
include ('inc/header.php');

?>
<?php foreach ($movies as $movie) {
    ; ?>

    <h1>Titre : <?= $movie['title']; ?></h1>

    <img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?= $movie['title']; ?>">


<?php } ?>

<?php


// Partie "Boucle"
while ($element = $query->fetch()) {
    // C'est là qu'on affiche les données  :)
}

// Partie "Liens"
?>
<?php
if ($page > 1){
    echo '<a href="index.php?page=' . ($page - 1) . '" class="btn btn-primary">Précédent</a>';
}

?>

<?php
if (empty($page)){
    echo '<a href="index.php?page=' . ($page + 1) . '" class="btn btn-primary">Suivant</a>';
}
?>
<?php
include('inc/footer.php');
