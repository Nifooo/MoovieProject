<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Manage Users';
$errors = array();
$succes = false;
if (idAdmin()){
    $sql = "SELECT * FROM users
        WHERE 1";


    $query = $pdo->prepare($sql);
    $query->execute();
    $users = $query->fetchAll();

//debug($users);

    include('inc/header.php'); ?>

    <h1 id="gens">Tous les utilisateurs</h1>
    <div class="manageuser">
    <?php foreach ($users as $user) {
        echo '<div class="user">';
        echo '- ' . $user['pseudo'] . ' ' . $user['email']. '';
//debug($users);

        echo '<br><a href=#><span>Modifier</span></a>';
        echo '<br><a href="deleteUserAdmin.php?id=' . $user['id'] . '"><span>Supprimer</span></a>';

        echo '</div>';
    } ?>
    </div>
<?php echo '<li><a href="index.php">Accueil</a></li>';

}else{
    echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
}