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
if (!empty($_POST['submitted'])) {


    $idmovie = $_POST['jj'];
    $userid = $_SESSION['login']['id'];
    $star = $_POST['star'];
    // jj  movie du film
    //echo '<p>' . $idmovie . ' & ' . $userid . ' & ' . $star . '</p>';
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
        header("Location: favUsers.php");
    }
}
require('inc/header.php');
?>
    <h5>Films noté</h5>
<?php
//debug($favUsers);
foreach ($favUsers As $favUser){
    ?>


    <div id="listefilm">
    <div class="wrap3">

    <a href="details.php?slug=<?php echo $favUser['slug']; ?>"><img class="affichefilm"

                                                                  src="<?php $img = 'posters/' . $favUser['id'] . '.jpg';

                                                                  if (file_exists($img)) {
                                                                      echo $img;
                                                                  } else {
                                                                      echo 'asset/img/dvd-logo.jpg';
                                                                  } ?>" alt="<?= $favUser['title']; ?>"></a>

    <h3>Titre : <?= $favUser['title']; ?></h3>
        <h4>Note : <?= $favUser['note']?>/5</h4>
        <h4>Modifier ma note</h4>
        <form method="post" action="">
            <select name="star">
                <option value="1">☆</option>
                <option value="2">☆☆</option>
                <option value="3">☆☆☆</option>
                <option value="4">☆☆☆☆</option>
                <option value="5">☆☆☆☆☆</option>
            </select>
            <input type="submit" name="submitted" value="Votez">
            <input type="hidden" name="jj" value="<?= $favUser['id'] ?>">
        </form>
    </div>
    </div>

    <?php
}?>
<div class="clear"></div>
<?php include('inc/footer.php');