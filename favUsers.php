<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;
debug($_SESSION);
$idusers = 2;
$sql = "SELECT * FROM movie_user AS mu
      LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
      WHERE mu.user_id = $idusers";
$query = $pdo->prepare($sql);
$query->execute();
$un = $query->fetchAll();

debug($un);
die();
if (isLogged()) {

    //jointure

    $idusers = $_SESSION['login']['id'];
    $sql = "SELECT id
        FROM movie_user
        JOIN users ON users.id = user_id.id
        JOIN movies_full ON movies_full.id = movie_id.id
        WHERE users.id = $idusers";

    $query = $pdo->prepare($sql);
    $query->execute();
    $un = $query->fetchAll();

    $sql ="SELECT *
    FROM movie_user
    WHERE 1 = 1";
    $query = $pdo->prepare($sql);
    $query->execute();

    $favUsers = $query->fetchAll();
    //$user_id = $favUsers['']['user_id'];
    //debug($user_id);
    var_dump($favUsers);
    if ($_SESSION['login']['id']===$_GET['login']['id']){
    //pagination





    foreach ($favUsers as $favUser) {
        ?>

        <section id="listefilm">
            <div class="wrap">
                <div class="centrage">
                    <div class="organisation">


                        <a href="details.php?id=<?php echo $favUser['movie_id']; ?>"><img
                                src="<?php
                                $img = 'posters/' . $favUser['movie_id'] . '.jpg';
                                if (file_exists($img)){
                                    echo $img;}else{
                                    echo 'asset/img/dvd-logo.jpg';
                                } ?>" alt=""></a>



                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    }
}
//debug($vaccins);
