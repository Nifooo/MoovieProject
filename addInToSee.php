<?php
session_start();
include('inc/pdo.php');
include('function/function.php');

$success = false;
if (!empty ($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;
    $sql = "SELECT * FROM movies_full
            WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movie = $query->fetch();

    if (!empty($_SESSION['login']['id'])){
        $users = $_SESSION['login']['id'];


        if (!empty($movie)) {
            $_POST['login']['id'];
//UPDATE
            $success = true;
            $sql = "INSERT INTO movie_user
               VALUE ('',:users,:id,'',NOW(),'')
              ";
            $query = $pdo->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':users', $users, PDO::PARAM_STR);
            $query->execute();

            header("Location: aVoir.php");


        } }else {
        //die('404');
    }


}


include('inc/header.php');
