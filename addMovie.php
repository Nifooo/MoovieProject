<?php
include('inc/pdo.php');
include('function/function.php');
$errors = array();
$success = false;
session_start();
if (!idAdmin()) {die('403');} 


if (!empty($_POST['submit'])) {
    $titre = clean($_POST['titre']);
    $annee = clean($_POST['annee']);
    $genre = clean($_POST['genre']);
    $resume = clean($_POST['resume']);
    $realisateur = clean($_POST['realisateur']);
    $acteur = clean($_POST['acteur']);
    $scenariste = clean($_POST['scenariste']);
    $vues = clean($_POST['vues']);
    $mpaa = clean($_POST['mpaa']);
    $popularite = clean($_POST['popularite']);
    $poster = clean($_POST['poster']);
    $ratio = clean($_POST['ratio']);
    $slug = $titre . '-' . $annee;

    $errors = textWalid($errors, $titre, 'title',1, 255);
    $errors = textWalid($errors, $annee, 'years',1,11);
    $errors = textWalid($errors, $genre, 'genres',2, 255);
    $errors = textWalid($errors, $resume, 'plot',10,4000);
    $errors = textWalid($errors, $realisateur, 'directors',2, 255);
    $errors = textWalid($errors, $acteur, 'cast',2 ,255);
    $errors = textWalid($errors, $scenariste, 'writers',2, 255);
    $errors = textWalid($errors, $vues, 'runtime',1,11);
    $errors = textWalid($errors, $mpaa, 'mpaa',1, 25);
    $errors = textWalid($errors, $popularite, 'popularity',1,11);
    $errors = textWalid($errors, $poster, 'poster_flag',1,2);
    $errors = textWalid($errors, $ratio, 'rating',1,2);

    if (count($errors) == 0) {
        $success = true;
        $sql = "INSERT INTO movies_full VALUES(null ,:slug ,:titre ,:annee ,:genre ,:resume ,:realisateur ,:acteur ,:scenariste ,:vue ,:mpaa ,:ratio ,:popularite ,NOW() ,NOW(),:poster)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':slug', $slug, PDO::PARAM_STR);
        $query->bindValue(':titre',$titre, PDO::PARAM_STR);
        $query->bindValue(':annee',$annee, PDO::PARAM_STR);
        $query->bindValue(':genre',$genre, PDO::PARAM_STR);
        $query->bindValue(':resume',$resume, PDO::PARAM_STR);
        $query->bindValue(':realisateur',$realisateur, PDO::PARAM_STR);
        $query->bindValue(':acteur',$acteur, PDO::PARAM_STR);
        $query->bindValue(':scenariste',$scenariste, PDO::PARAM_STR);
        $query->bindValue(':vue',$vues, PDO::PARAM_STR);
        $query->bindValue(':mpaa',$mpaa, PDO::PARAM_STR);
        $query->bindValue(':ratio',$ratio, PDO::PARAM_STR);
        $query->bindValue(':popularite',$popularite, PDO::PARAM_STR);
        $query->bindValue(':poster', $poster, PDO::PARAM_STR);
        $query->execute();
    }

}

include('inc/header.php');

if($success) { ?>
    <p class="success">Votre film à bien été posté. <a href="admin.php"> Retour au pannel admin</a></p>
<?php } else { ?>

<div class="wrap">

    <h2 class="adminajout">Ajouter un film</h2>

    <form class="adminform" novalidate method="post">

        <input type="text" name="titre" id="titre" placeholder="Titre" value="<?php if (!empty($_POST['title'])) { echo $_POST['title']; } ?>">
        <span class="error"><?php if (!empty($errors['title'])) { echo $errors['title']; } ?></span>

        <input type="number" name="annee" id="annee" placeholder="Année" value="<?php if (!empty($_POST['years'])) { echo $_POST['years']; } ?>">
        <span class="error"><?php if (!empty($errors['years'])) { echo $errors['years']; } ?></span>

        <input type="text" name="genre" id="genre" placeholder="Genre" value="<?php if (!empty($_POST['genres'])) { echo $_POST['genres']; } ?>">
        <span class="error"><?php if (!empty($errors['genres'])) { echo $errors['genres']; } ?></span>

        <input type="text" name="resume" id="resume" placeholder="Resumé" value="<?php if (!empty($_POST['plot'])) { echo $_POST['plot']; } ?>">
        <span class="error"><?php if (!empty($errors['plot'])) { echo $errors['plot']; } ?></span>

        <input type="text" name="realisateur" id="realisateur" placeholder="Réalisateur" value="<?php if (!empty($_POST['directors'])) { echo $_POST['directors']; } ?>">
        <span class="error"><?php if (!empty($errors['directors'])) { echo $errors['directors']; } ?></span>

        <input type="text" name="acteur" id="acteur" placeholder="Acteurs" value="<?php if (!empty($_POST['cast'])) { echo $_POST['cast']; } ?>">
        <span class="error"><?php if (!empty($errors['cast'])) { echo $errors['cast']; } ?></span>

        <input type="text" name="scenariste" id="scenariste" placeholder="Scénaristes" value="<?php if (!empty($_POST['writers'])) { echo $_POST['writers']; } ?>">
        <span class="error"><?php if (!empty($errors['writers'])) { echo $errors['writers']; } ?></span>

        <input type="number" name="vues" id="vues" placeholder="Vues" value="<?php if (!empty($_POST['runtime'])) { echo $_POST['runtime']; } ?>">
        <span class="error"><?php if (!empty($errors['runtime'])) { echo $errors['runtime']; } ?></span>

        <input type="text" name="mpaa" id="mpaa" placeholder="Mpaa" value="<?php if (!empty($_POST['mpaa'])) { echo $_POST['mpaa']; } ?>">
        <span class="error"><?php if (!empty($errors['mpaa'])) { echo $errors['mpaa']; } ?></span>

        <input type="text" name="ratio" id="ratio" placeholder="Ratio" value="<?php if (!empty($_POST['rating'])) { echo $_POST['rating']; } ?>">
        <span class="error"><?php if (!empty($errors['rating'])) { echo $errors['rating']; } ?></span>

        <input type="number" name="popularite" id="popularite" placeholder="Popularité" value="<?php if (!empty($_POST['popularity'])) { echo $_POST['popularity']; } ?>">
        <span class="error"><?php if (!empty($errors['popularity'])) { echo $errors['popularity']; } ?></span>

        <input type="number" name="poster" id="poster" placeholder="Poster Flag" value="<?php if (!empty($_POST['poster_flag'])) { echo $_POST['poster_flag']; } ?>">
        <span class="error"><?php if (!empty($errors['poster_flag'])) { echo $errors['poster_flag']; } ?></span>

        <input type="submit" class="adminenvoi" name="submit" value="Ajouter le film">

    </form>
</div>
<div class="clear"></div> <?php }


include('inc/footer.php');
