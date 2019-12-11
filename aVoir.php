<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Film a voir';
$errors = array();
$succes = false;

if (!isLogged()) {
    header("Location: 403.html");
}
$idusers = $_SESSION['login']['id'];
$sql = "SELECT * FROM movie_user AS mu
      LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
      WHERE mu.user_id = $idusers
      AND note IS NULL";

$query = $pdo->prepare($sql);
$query->execute();
$movie = $query->fetchAll();
//debug($movie);
//requete film a voir
if (!empty($_POST['submitted'])) {


    $idmovie = $_POST['jj'];
    $userid = $_SESSION['login']['id'];
    $star = $_POST['star'];
    // jj  movie du film
    echo '<p>' . $idmovie . ' & ' . $userid . ' & ' . $star . '</p>';
    // $user_id

    // SELECT
    $sql = "SELECT * FROM movie_user 
WHERE movie_id = :idmovie AND user_id = :userid";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idmovie', $idmovie, PDO::PARAM_INT);
    $query->bindValue(':userid', $userid, PDO::PARAM_INT);


    $query->execute();
    $fav = $query->fetchAll();
//debug($sql);

    //  request
    if (!empty($fav)) {
        $note = clean($_POST['star']);
        $sql = "UPDATE movie_user
    SET note = :note , modified_at = NOW()
    WHERE movie_id = :idmovie AND user_id = :userid";
        $query = $pdo->prepare($sql);
        $query->bindValue(':userid', $userid, PDO::PARAM_INT);

        $query->bindValue(':idmovie', $idmovie, PDO::PARAM_INT);
        $query->bindValue(':note', $note, PDO::PARAM_STR);
        $query->execute();
    }
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

            <form method="post" action="">
                <select name="star">
                    <option value="1">☆</option>
                    <option value="2">☆☆</option>
                    <option value="3">☆☆☆</option>
                    <option value="4">☆☆☆☆</option>
                    <option value="5">☆☆☆☆☆</option>
                </select>
                <input type="submit" name="submitted" value="Votez">
                <input type="hidden" name="jj" value="<?= $movia['id'] ?>">
            </form>
        </div>
    </div>


<?php } ?>
    <div class="clear"></div>
<?php include('inc/footer.php');