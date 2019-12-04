<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;

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

//chekbox
if (!empty($_POST['submitted'])) {
    $_POST['cat'];
    //print_r($_POST['cat']);
    $cats = $_POST['cat'];

        $filter = '%'. $cats .'%';

        $sql = "SELECT * FROM movies_full WHERE 1 = 1";
        foreach ($cats as $cat){
        $sql .= " AND genres LIKES $filter";
        }


        $query = $pdo->prepare($sql);
        $query->execute();
        $movia = $query->fetch();


}

include('inc/header.php');

?>

    <a href="index.php"><img width="100%" src="asset/img/joker.png" alt="Affiche de film du joker"></a>
    <h1>Moovie Project</h1>
    <p class="sous-titre">Liste de 100 films du classement</p>

    <section id="check">
        <div class="wrap">
            <form method="post" action="">

                <input type="checkbox" class="drama" name="cat[]" value="Drama">
                <label for="drama">Drama</label>

                <input type="checkbox" class="western" name="cat[]" value="Western">
                <label for="western">Western</label>

                <input type="checkbox" class="crime" name="cat[]" value="Crime">
                <label for="crime">Crime</label>

                <input type="checkbox" class="comedy" name="cat[]" value="Comedy">
                <label for="comedy">Comedy</label>

                <input type="checkbox" class="action" name="cat[]" value="Action">
                <label for="action">Action</label>

                <input type="checkbox" class="aventure" name="cat[]" value="Aventure">
                <label for="aventure">Aventure</label>

                <input type="checkbox" class="thriller" name="cat[]" value="Thriller">
                <label for="thriller">Thriller</label>

                <input type="checkbox" class="romance" name="cat[]" value="Romance">
                <label for="romance">Romance</label>

                <input type="checkbox" class="war" name="cat[]" value="War">
                <label for="war">War</label>

                <input type="checkbox" class="horror" name="cat[]" value="Horror">
                <label for="horror">Horror</label>

                <input type="checkbox" class="mystery" name="cat[]" value="Mystery">
                <label for="mystery">Mystery</label>

                <input type="checkbox" class="film-noir" name="cat[]" value="film-noir">
                <label for="film-noir">Film-noir</label>

                <input type="checkbox" class="short" name="cat[]" value="Short">
                <label for="short">Short</label>

                <input type="checkbox" class="music" name="cat[]" value="Music">
                <label for="music">Music</label>

                <input type="checkbox" class="sci-fi" name="cat[]" value="Sci-fi">
                <label for="sci-fi">Sci-Fi</label>

                <input type="checkbox" class="musical" name="cat[]" value="Musical">
                <label for="musical">Musical</label>

                <input type="checkbox" class="family" name="cat[]" value="Family">
                <label for="family">Family</label>

                <input type="checkbox" class="animation" name="cat[]" value="Animation">
                <label for="animation">Animation</label>

                <input type="checkbox" class="adventure" name="cat[]" value="Adventure">
                <label for="adventure">Adventure</label>

                <input type="submit" name="submitted" value="Filtrer">
            </form>
        </div>
    </section>
<?php
paginationIdea($page, $num, $count);
foreach ($movies as $movie) {
    ;; ?>
    <section id="listefilm">
        <div class="wrap">
            <div class="centrage">
                <div class="organisation">


                    <a href="details.php?id=<?php echo $movie['id']; ?>"><img
                                src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?= $movie['title']; ?>"></a>

                    <h3>Titre : <?= $movie['title']; ?></h3>

                </div>
            </div>
        </div>
    </section>


<?php }
paginationIdea($page, $num, $count); ?>


    <div class="clear"></div>

<?php
include('inc/footer.php');
