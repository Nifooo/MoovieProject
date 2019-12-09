<?php
session_start();
include('inc/pdo.php');
include('function/function.php');


if (!empty($_GET['slug'])) {
    $slug = $_GET['slug'];


    $sql = "SELECT * FROM movies_full WHERE slug LIKE '" . $slug . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movie = $query->fetch();


    if (!empty($movie)) {
        $btn = true;

        if (isLogged()) {
            $iduser = $_SESSION['login']['id'];
            $idmovie = $movie['id'];

            $sql = "SELECT * FROM movie_user WHERE user_id = :iduser AND movie_id = :movieid";
            $query = $pdo->prepare($sql);
            $query->bindValue(':iduser', $iduser, PDO::PARAM_INT);
            $query->bindValue(':movieid', $idmovie, PDO::PARAM_STR);
            $query->execute();
            $boutonfav = $query->fetch();

            if (!empty($boutonfav)) {
                $btn = false;
            }
        }


    } else {
        die('404');
    }

} else {
    die('404');
}



$title =$movie['title'] . '-' . $movie['year'];
include('inc/header.php'); ?>

    <div class="films">
        <h2><?php echo $movie['title']; ?></h2>
        <img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?= $movie['title']; ?>">
        <p>Année : <?php echo $movie['year'] ?></p>
        <p>Genres : <?php echo $movie['genres'] ?></p>
        <p>Intrigue : <?php echo $movie['plot'] ?></p>
        <p>Directeur : <?php echo $movie['directors'] ?></p>
        <p>Casting : <?php echo $movie['cast'] ?></p>
        <p>Scénario : <?php echo $movie['writers'] ?></p>
        <p>Vues : <?php echo $movie['runtime'] ?></p>
        <p>Note : <?php echo $movie['rating'] ?></p>
        <p>Popularité : <?php echo $movie['popularity'] ?></p>
        <?php if ( isLogged() && $btn){ ?>
        <a class="toosee" href="addInToSee.php?id=<?= $movie['id']?>">Ajouter à mes films à voir</a> <?php } ?>
    <div class="clear"></div>
    </div>


<?php include('inc/footer.php');
