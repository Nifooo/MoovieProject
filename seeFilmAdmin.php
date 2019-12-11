<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
require('vendor/autoload.php');

use JasonGrimes\Paginator;

$title = 'Home Page';
$errors = array();
$succes = false;
if (!idAdmin()) {die('403');}
$page = 1;
if(!empty($_GET['page'])){
    $page = $_GET['page'];
}


//nombre de film 100
    $num = 100;


//offset par défaut
    $offset = 0;
//affichage film random


//inclus les paramètres d'offset pour la pagination et order by DESC
    $sql = "SELECT * FROM movies_full
ORDER BY popularity DESC
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

$totalItems = $count; //count(movie)
$itemsPerPage = 50;
$currentPage = $page;
$urlPattern = 'SeeFilmAdmin.php?page=(:num)';

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

    ?>
    <?php
include ('inc/header.php');
    foreach ($movies as $movie) {

        ;; ?>
        <section id="listefilm">
            <div class="wrap">
                <div class="centrage">
                    <div class="organisation">


                        <a href="details.php?id=<?php echo $movie['id']; ?>"><img
                                    src="<?php
                                    $img = 'posters/' . $movie['id'] . '.jpg';
                                    if (file_exists($img)) {
                                        echo $img;
                                    } else {
                                        echo 'asset/img/dvd-logo.jpg';
                                    } ?>" alt="<?= $movie['title']; ?>"></a>

                        <h3>Titre : <?= $movie['title']; ?></h3>

                    </div>
                </div>
            </div>
        </section>


    <?php } ?>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<?php

    echo $paginator;
    echo '<li><a href="index.php">Accueil</a></li>';



include('inc/footer.php');
