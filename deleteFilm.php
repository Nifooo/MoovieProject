<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;
if (idAdmin()){
    if ($_GET['id'] && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM movies_full WHERE id = $id";
        $query = $pdo ->prepare($sql);
        //$query -> bindValue(':id',$id,PDO::PARAM_INT);
        $query -> execute();

        echo "Vous avez bien supprimé votre utilsateurs";
        header("Location: seeFilmAdmin.php");

    }

}else{
    echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
}


include('inc/footer.php');