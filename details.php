<?php

include('inc/pdo.php');
include('function/function.php');


if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];



    $sql = "SELECT * FROM movies_full WHERE ID = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movie = $query->fetch();

    if (!empty($movie)) {

    } else {
        die('404');
    }

} else {
    die('404');
}



$title =$movie['title'] . '-' . $movie['created'];
include('inc/header.php'); ?>

    <div class="films">
        <h2><?php echo $movie['title']; ?></h2>
        <img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?= $movie['title']; ?>">
        <p>Année:<?php echo $movie['year'] ?></p>
        <p>Genres:<?php echo $movie['genres'] ?></p>
        <p>Intrigue:<?php echo $movie['plot'] ?></p>
        <p>Directeur:<?php echo $movie['directors'] ?></p>
        <p>Casting:<?php echo $movie['cast'] ?></p>
        <p>Scénario:<?php echo $movie['writers'] ?></p>
        <p>Vues:<?php echo $movie['runtime'] ?></p>
        <p>Note:<?php echo $movie['rating'] ?></p>
        <p>Popularité:<?php echo $movie['popularity'] ?></p>
        <a href="addInMyFav.php?id=<?= $movie['id']?>">Add Fav</a>

    </div>


<?php include('inc/footer.php');
