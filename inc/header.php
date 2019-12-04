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
            <li><a href="index.php">Home</a></li>
            <?php if (!isLogged()) { ?>
                <li><a href="register.php">Inscriptions</a></li>
                <li><a href="login.php">Login</a></li>

            <?php } else { ?>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="">Mon compte</a></li>
                <li><a href="">Mes favoris</a></li>

                <li>Bonjour <?php echo $_SESSION['login']['pseudo'] ?> !</li>
            <?php } ?>
        </ul>
    </nav>
    <div class="clear"></div>
</header>
