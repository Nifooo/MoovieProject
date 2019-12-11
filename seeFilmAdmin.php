<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;
if (idAdmin()){
//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;
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
ORDER BY id DESC
 LIMIT $num 
 OFFSET $offset ";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

//requête pour compter le nombre de lignes dans la table
$sql = "SELECT COUNT(*) FROM movies_full";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$count = $stmt->fetchColumn();?>
<a href="index.php">Home</a>
<?php paginationIdeaSeefilm($page, $num, $count);
    include ('inc/header.php');
foreach ($movies as $movie) {

    ;; ?>




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


<?php }
paginationIdeaSeefilm($page, $num, $count);
    echo '<li><a href="index.php">Accueil</a></li>';
}else{
    echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
}


include('inc/footer.php');
