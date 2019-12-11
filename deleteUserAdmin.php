<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;
if (!idAdmin()) {die('403');}
if ($_GET['id'] && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id = $id";
        $query = $pdo ->prepare($sql);
        //$query -> bindValue(':id',$id,PDO::PARAM_INT);
        $query -> execute();

        echo "Vous avez bien supprimé votre utilsateurs";
        header("Location: manageUsers.php");

    }




include('inc/footer.php');