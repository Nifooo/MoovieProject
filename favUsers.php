<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;

//debug($un);
//die();
if (!isLogged()) {
    header("Location: 403.html");
}
$userid = $_SESSION['login']['id'];

$sql = "SELECT * FROM movie_user AS mu
      LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
      WHERE mu.user_id = $userid
      AND note";

$query = $pdo->prepare($sql);
$query->execute();
$favUsers = $query->fetchAll();
//debug($favUsers);
require('inc/header.php');
foreach ($favUsers As $favUser){
    ?>


    <div id="listefilm">
    <div class="wrap">

    <a href="details.php?slug=<?php echo $favUser['slug']; ?>"><img class="affichefilm"

                                                                  src="<?php $img = 'posters/' . $favUser['id'] . '.jpg';

                                                                  if (file_exists($img)) {
                                                                      echo $img;
                                                                  } else {
                                                                      echo 'asset/img/dvd-logo.jpg';
                                                                  } ?>" alt="<?= $favUser['title']; ?>"></a>

    <h3>Titre : <?= $favUser['title']; ?></h3>
        <h4>Note : <?= $favUser['note']?>/5</h4>
    </div>
    </div>

    <?php
}?>
<div class="clear"></div>
<?php include('inc/footer.php');