<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Film a voir';
$errors = array();
$succes = false;

if (isLogged()) {
    $idusers = $_SESSION['login']['id'];
    $sql = "SELECT * FROM movie_user AS mu
      LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
      WHERE mu.user_id = $idusers
      AND note IS NULL";

    $query = $pdo->prepare($sql);
    $query->execute();
    $movie = $query->fetchAll();
//requete film a voir


} else {
    echo "Erreur 403, vous n'avez pas accès a cette fonctionnalité";
}
require('inc/header.php');
//foreach
foreach ($movie as $movia) { ?>

    <div id="listefilm">
        <div class="wrap">

            <a href="details.php?slug=<?php echo $movia['slug']; ?>"><img class="affichefilm"

              src="<?php $img = 'posters/' . $movia['id'] . '.jpg';

              if (file_exists($img)) {
                  echo $img;
              } else {
                  echo 'asset/img/dvd-logo.jpg';
              } ?>" alt="<?= $movia['title']; ?>"></a>

            <h3>Titre : <?= $movia['title']; ?></h3>


        </div>
    </div>
<?php } ?>

<div class="clear"></div>

<?php include('inc/footer.php');