<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Manage Users';
$errors = array();
$succes = false;
if (idAdmin()){
    $sql = "SELECT * FROM movies_full
        WHERE 1";


    $query = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll();
//nombre de film par page
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
//inclus les paramètres d'offset pour la pagination et order by DESC
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


//debug($users);
    include('inc/header.php'); ?>

    <h1 id="gens">Modifier les films</h1>
    <?php
    paginationIdeaManageFilm($page, $num, $count);
    foreach ($movies as $movie) {
        echo '<div class="user">'; ?>
<section id="listefilm">
    <div class="wrap">

        <a href="details.php?id=<?php echo $movie['id']; ?>"><img
                    src="<?php
                    $img = 'posters/' . $movie['id'] . '.jpg';
                    if (file_exists($img)){
                        echo $img;}else{
                        echo 'asset/img/dvd-logo.jpg';
                    } ?>" alt="<?= $movie['title']; ?>"></a>

        <h3>Titre : <?= $movie['title']; ?></h3>
    </div>
</section>
<?php //debug($users);

        echo '<br><a href="updateFilm.php?id='. $movie['id'] . '"><span>Modifier</span></a>';
        echo '<br><a href="deleteFilm.php?id=' . $movie['id'] . '"><span>Supprimer</span></a>';

        echo '</div>';
    }
    paginationIdeaManageFilm($page, $num, $count);

}else{
    echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
}

include('inc/footer.php');