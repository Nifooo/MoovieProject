<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php if (!empty($title)) {
            echo $title;
        } else {
            echo '';
        } ?></title>
    <link rel="stylesheet" href="asset/css/style.css">

</head>
<body>
<header>
    <img src="asset/img/thelogo.png" alt="Logo du site MoovieProject : Faite partie du cinéma">
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (!isLogged()) { ?>
                <li><a href="register.php">Inscriptions</a></li>
                <li><a href="login.php">Connexion</a></li>

            <?php }elseif(idAdmin()){?>
                <li><a href="logout.php">Deconnexion</a></li>
                <li><a href="admin.php">Pannel admin</a></li>
                <li><a href="monCompte.php">Mon compte</a></li>
                <li><a href="favUsers.php">Mes favoris</a></li>
           <?php }  else { ?>
                <div class="head2">
            <li><a href="logout.php">Deconnexion</a></li>
            <li><a href="monCompte.php">Mon compte</a></li>
            <li><a href="favUsers.php">Mes favoris</a></li>
                </div>

            <li class="bienvenue">Bonjour <?php echo $_SESSION['login']['pseudo'] ?> !</li>
            <?php }?>
        </ul>
    </nav>
    <div class="clear"></div>
</header>
