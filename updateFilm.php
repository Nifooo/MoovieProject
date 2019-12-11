<?php
session_start();
include('inc/pdo.php');
include('function/function.php');
$title = 'Update';
$errors = array();
$success = false;
if (!idAdmin()) {header("Location: 403.html");}
    if (!empty ($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
    }
//Select=colonne; FROM= table; WHERE -> col1 = valeur; AND col2 = valeur2; ORDER BY = col ASC/DESC ; LIMIT = combien;
        $sql = "SELECT * FROM movies_full
            WHERE ID = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        $movies = $query->fetch();
        //debug($citys);
        if (!empty($movies)) {
            if (!empty($_POST['submitted'])) {
                //debug($_POST);
                $title = clean($_POST['title']);
                $year = clean($_POST['year']);
                $genres = clean($_POST['genres']);
                $plot = clean($_POST['plot']);
                $directors = clean($_POST['directors']);
                $cast = clean($_POST['cast']);
                $writers = clean($_POST['writers']);


                $errors = textWalid($errors, $title, 'title', 2, 200);
                $errors = textWalid($errors, $genres, 'genres', 2, 200);
                $errors = textWalid($errors, $plot, 'plot', 2, 200);
                $errors = textWalid($errors, $directors, 'directors', 2, 200);
                $errors = textWalid($errors, $cast, 'cast', 2, 200);
                $errors = textWalid($errors, $writers, 'writers', 2, 200);


                // no error
                if (count($errors) == 0) {
                    // insert into
                    $success = true;

                    $sql = "UPDATE movies_full
               SET title = :title, year = :year, genres = :genres, plot = :plot, directors = :directors, cast = :cast, writers = :writers
               WHERE ID = $id";
                    $query = $pdo->prepare($sql);
                    $query->bindValue(':title', $title, PDO::PARAM_STR);
                    $query->bindValue(':year', $year, PDO::PARAM_STR);
                    $query->bindValue(':genres', $genres, PDO::PARAM_STR);
                    $query->bindValue(':plot', $plot, PDO::PARAM_INT);
                    $query->bindValue(':directors', $directors, PDO::PARAM_STR);
                    $query->bindValue(':cast', $cast, PDO::PARAM_STR);
                    $query->bindValue(':writers', $writers, PDO::PARAM_STR);
                    $query->execute();


                }
            }
        } else {
            die('404');
        }
//debug($citys);
    include('inc/header.php');
    ?>
    <?php if ($success) { ?>
        <p class="success">Tu as bien rajouté un film !</p>
    <?php } else { ?>
        <form method="post" action="">
            <fieldset>
                <div>
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="<?php if (!empty($_POST['title'])) {
                        echo $_POST['title'];
                    } else {
                        echo $movies['title'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['title'])) {
                            echo $errors['title'];
                        }
                        ?></span>
                </div>
                <div>
                    <label for="year">Date :</label>
                    <input type="date" id="year" name="year" value="<?php if (!empty($_POST['year'])) {
                        echo $_POST['year'];
                    } else {
                        echo $movies['year'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['year'])) {
                            echo $errors['year'];
                        }
                        ?></span>
                </div>
                <div>
                    <label for="genres">Genres :</label>
                    <input type="text" id="genres" name="genres" value="<?php if (!empty($_POST['genres'])) {
                        echo $_POST['genres'];
                    } else {
                        echo $movies['genres'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['genres'])) {
                            echo $errors['genres'];
                        }
                        ?></span>
                </div>
                <div>
                    <label for="plot">Plot :</label>
                    <input type="text" id="plot" name="plot" value="<?php if (!empty($_POST['plot'])) {
                        echo $_POST['plot'];
                    } else {
                        echo $movies['plot'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['plot'])) {
                            echo $errors['plot'];
                        }
                        ?></span>
                </div>
                <div>
                    <label for="directors">Directeur(s) :</label>
                    <input type="text" id="directors" name="directors" value="<?php if (!empty($_POST['directors'])) {
                        echo $_POST['directors'];
                    } else {
                        echo $movies['directors'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['directors'])) {
                            echo $errors['directors'];
                        }
                        ?></span>
                </div>
                <div>
                    <label for="cast">Cast :</label>
                    <input type="text" id="cast" name="cast" value="<?php if (!empty($_POST['cast'])) {
                        echo $_POST['cast'];
                    } else {
                        echo $movies['cast'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['cast'])) {
                            echo $errors['cast'];
                        }
                        ?></span>
                </div>
                <div>
                    <label for="writers">Ecrivain :</label>
                    <input type="text" id="writers" name="writers" value="<?php if (!empty($_POST['writers'])) {
                        echo $_POST['writers'];
                    } else {
                        echo $movies['writers'];
                    } ?>">
                    <span class="error"><?php if (!empty($errors['writers'])) {
                            echo $errors['writers'];
                        }
                        ?></span>
                </div>


                <div>
                    <input class="blue_button" name="submitted" type="submit" value="Envoyer"/>
                    <input class="blue_button" type="reset" value="Effacer"/>
                </div>
            </fieldset>
            <input type="hidden" name="city"/>
        </form>
    <?php }

include('inc/footer.php');
