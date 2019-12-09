<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
$errors = array();
$succes = false;
debug($_SESSION);
$idusers = 2;
//jointure
$sql = "SELECT * FROM movie_user AS mu
      LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
      WHERE mu.user_id = $idusers
        AND note IS NULL";
$query = $pdo->prepare($sql);
$query->execute();
$un = $query->fetchAll();

debug($un);
die();
if (isLogged()) {




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
                                        if (file_exists($img)) {
                                            echo $img;
                                        } else {
                                            echo 'asset/img/dvd-logo.jpg';
                                        } ?>" alt=""></a>


                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }

include('inc/header.php');



