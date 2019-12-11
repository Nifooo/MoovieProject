<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
require('vendor/autoload.php');


$title = 'Home Page';
$errors = array();
$succes = false;

//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;
//nombre de film 100
$num = 100;


//offset par défaut
$offset = 0;
//affichage film random
$sql = "SELECT * FROM movies_full
ORDER BY RAND()
 LIMIT $num 
 OFFSET $offset ";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();


//chekbox
//if (!empty($_POST['submitted'])) {
//    $_POST['cat'];
////    print_r($_POST['cat']);
//    $cats = $_POST['cat'];
//
//        $filter = '%'. $cats .'%';
//
//        $sql = "SELECT * FROM movies_full WHERE 1 = 1";
//        foreach ($cats as $cat){
//        $sql .= " AND genres LIKES $filter";
//        }
//
//
//        $query = $pdo->prepare($sql);
//        $query->execute();
//        $checkU = $query->fetch();
//
//}
//debug($_POST);


// $checkU = $query->fetch();
if (!empty($_GET['submitted'])) {
//debug($_POST);
    $sql = "SELECT * FROM movies_full WHERE 1=1";

    if (!empty($_GET['cat'])) {
        $genre = $_GET['cat'];
        $sql .= ' AND ( genres LIKE "%' . $genre[0] . '%"';
        for ($i = 1; $i < count($genre); $i++) {
            $sql .= ' OR genres LIKE "%' . $genre[$i] . '%"';
        }
        $sql .= ')';

    }
    if (!empty($_GET['min'])) {
        if (!empty($_GET['max'])) {
            $min = $_GET['min'];
            $max = $_GET['max'];
            $sql .= " AND year BETWEEN $min AND $max";

    $sql .= " ORDER BY RAND()";
    $sql .= " LIMIT 4";


        }
    } //debug($_SESSION);
    $query = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll();
}


include('inc/header.php');

//debug($_SESSION);
?>

    <a href="index.php"><img width="100%" src="asset/img/joker.png" alt="Affiche de film du joker"></a>
    <h1>Moovie Project</h1>

    <div class="wrap">

        <form class="vertical" method="get" action="">

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

            <div class="barre"></div>

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


            <label for="datemin">/Date min :</label>
            <input type="text" class="datemin" name="min">

            <label for="datemax">Date max :</label>
            <input type="text" class="datemax" name="max">


            <input type="submit" class="filtre" name="submitted" value="Filtrer">
        </form>

    </div>
<?php

foreach ($movies as $movie) {

    ;; ?>
    <div id="listefilm">
        <div class="wrap">

            <a href="details.php?slug=<?php echo $movie['slug']; ?>"><img class="affichefilm"
                                                                          src="<?php
                                                                          $img = 'posters/' . $movie['id'] . '.jpg';
                                                                          if (file_exists($img)) {
                                                                              echo $img;
                                                                          } else {
                                                                              echo 'asset/img/dvd-logo.jpg';

                                                                          } ?>" alt="<?= $movie['title']; ?>"></a>

            <h3>Titre : <?= $movie['title']; ?></h3>

        </div>
    </div>


<?php }
?>


    <div class="clear"></div>

<?php
include('inc/footer.php');
