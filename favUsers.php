<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;
if (!isLogged()) {
    //jointure
    $idusers = $_SESSION['login']['id'];
    $sql = "SELECT id, id
        FROM movie_user
        JOIN users ON users.id = user_id.id
        JOIN movies_full ON movies_full.id = movie_id.id
        WHERE users.id = $idusers";
    $query = $pdo->prepare($sql);
    $query->execute();
    $favUsers = $query->fetchAll();
    //pagination
    $num = 100;

//numéro de page
    $page = 1;

//offset par défaut
    $offset = 0;

//écrasée par celui de l'URL si get['page'] n'est pas vide
    if (!empty($_GET['page'])) {
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

//debug($userVaccins);
    echo '<div class = filmUsers>';

    echo '<p>Vos films :</p>';
    echo '<br>';
    echo '<br>';
    paginationIdea($page, $num, $count);
    foreach ($favUsers as $favUser) {
        echo '<p class="titleMovie">- ' . $favUser->title . '</p>';
        echo '<br>';
        echo '<br>';
    }
    paginationIdea($page, $num, $count);

    $sql = "SELECT * FROM movies_full
            WHERE 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movie = $query->fetchAll();
//debug($vaccins);
    if (!empty($_POST['submitted'])) {

        $idmovie = clean($_POST['movie']);

        $sql = "INSERT INTO movie_user (user_id,movie_id) 
        VALUES (:iduser, :idmovie)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':iduser', $idusers, PDO::PARAM_INT);
        $query->bindValue(':idmovie', $idmovie, PDO::PARAM_INT);
        $query->execute();
    }
}
