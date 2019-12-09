<?php
session_start();
include('inc/pdo.php');
include('function/function.php');

$success = false;
if (isLogged()) {
    if (!empty ($_GET['id']) && is_numeric($_GET['id'])) {
        $movie_id = $_GET['id'];
//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;
        $sql = "SELECT * FROM movies_full
            WHERE id = $movie_id";
        $query = $pdo->prepare($sql);
        $query->execute();
        $movie = $query->fetch();

        //where id = movie
        //if exist

        if (!empty($movie)) {
            $user_id = $_SESSION['login']['id'];
//UPDATE
            $success = true;
            $sql = "INSERT INTO movie_user
               VALUE ('',:user_id,:movie_id,null,NOW(),'')
              ";
            $query = $pdo->prepare($sql);
            $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query->bindValue(':movie_id', $movie_id, PDO::PARAM_STR);
            $query->execute();
            // $tests = $query->fetchAll();
            header("Location: aVoir.php");


        }
    } else {
        echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
    }
}
