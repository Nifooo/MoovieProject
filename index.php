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
if (!empty($_GET['page'])){
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

include ('inc/header.php');

?>

    <img width="100%" src="asset/img/joker.png" alt="Affiche de film du joker">
    <h1>Moovie Project</h1>
    <p class="sous-titre">Liste de 100 films du classement</p>

    <section id="check">
        <div class="wrap">
            <form>

                <input type="checkbox" class="drama" name="drama">
                <label for="drama">Drama</label>

                <input type="checkbox" class="western" name="western">
                <label for="western">Western</label>

                <input type="checkbox" class="crime" name="crime">
                <label for="crime">Crime</label>

                <input type="checkbox" class="comedy" name="comedy">
                <label for="comedy">Comedy</label>

                <input type="checkbox" class="action" name="action">
                <label for="action">Action</label>

                <input type="checkbox" class="aventure" name="aventure">
                <label for="aventure">Aventure</label>

                <input type="checkbox" class="thriller" name="thriller">
                <label for="thriller">Thriller</label>

                <input type="checkbox" class="romance" name="romance">
                <label for="romance">Romance</label>

                <input type="checkbox" class="war" name="war">
                <label for="war">War</label>

                <input type="checkbox" class="horror" name="horror">
                <label for="horror">Horror</label>

                <input type="checkbox" class="mystery" name="mystery">
                <label for="mystery">Mystery</label>

                <input type="checkbox" class="film-noir" name="film-noir">
                <label for="film-noir">Film-noir</label>

                <input type="checkbox" class="short" name="short">
                <label for="short">Short</label>

                <input type="checkbox" class="music" name="music">
                <label for="music">Music</label>

                <input type="checkbox" class="sci-fi" name="sci-fi">
                <label for="sci-fi">Sci-Fi</label>

                <input type="checkbox" class="musical" name="musical">
                <label for="musical">Musical</label>

                <input type="checkbox" class="family" name="family">
                <label for="family">Family</label>

                <input type="checkbox" class="animation" name="animation">
                <label for="animation">Animation</label>

                <input type="checkbox" class="adventure" name="adventure">
                <label for="adventure">Adventure</label>

            </form>
        </div>
    </section>
<?php
paginationIdea($page,$num,$count);
foreach ($movies as $movie) {
    ;
    ; ?>
    <section id="listefilm">
    <div class="wrap">

    <div class="centrage">
        <div class="organisation">
    <h1>Titre : <?= $movie['title']; ?></h1>

    <a href="details.php?id=<?php echo $movie['id'];?>"><img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?= $movie['title']; ?>"></a>
        </div>
    </div>

    </div>
        <div class="clear"></div>
    </section>

<?php }
paginationIdea($page,$num,$count);?>




<?php
include('inc/footer.php');
