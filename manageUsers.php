<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Manage Users';
$errors = array();
$succes = false;
include('inc/footer.php');
if (idAdmin()){
    $sql = "SELECT * FROM users
        WHERE 1";


    $query = $pdo->prepare($sql);
    $query->execute();
    $users = $query->fetchAll();

//debug($users); ?>

    <h1 id="gens">Show users</h1>
    <?php foreach ($users as $user) {
        echo '<div class="user">';
        echo '- ' . $user['pseudo'] . ' ' . $user['email']. '';
//debug($users);

        echo '<br><a href=#><span>Edit</span></a>';
        echo '<br><a href="deleteUserAdmin.php?id=' . $user['id'] . '"><span>Delete</span></a>';

        echo '</div>';
    }
echo '<li><a href="index.php">Accueil</a></li>';

}else{
    echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
}