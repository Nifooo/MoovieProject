<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
if (!isLogged()){header("Location: 403.html");}
if ($_GET['id'] && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM movie_user WHERE movie_id = $id";
    $query = $pdo ->prepare($sql);
    //$query -> bindValue(':id',$id,PDO::PARAM_INT);
    $query -> execute();

    echo "Vous avez bien supprimé votre utilsateurs";
    header("Location: aVoir.php");

}



include('inc/footer.php');
