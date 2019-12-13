<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Connexion';
$errors = array();
$succes = false;
if (!empty($_POST['submitted'])) {
    $login = clean($_POST['login']);
    $password = clean($_POST['password']);

    if (empty($login) || empty($password)) {
        $errors['login'] = 'Veuillez renseigner ce champ';
    } else {
        $sql = "SELECT * FROM users WHERE pseudo = :login OR email = :login";
        $query = $pdo->prepare($sql);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if (!empty($user)) {
            //debug($user);

            if (password_verify($password, $user['password'])) {
                //die('ok');
                $_SESSION['login'] = array(
                    'id' => $user['id'],
                    'pseudo' => $user['pseudo'],
                    'role' => $user['role'],
                    'ip' => $_SERVER['REMOTE_ADDR']
                );
                //debug($_SESSION);
                header('Location: pendu.php');
            } else {
                $errors['login'] = 'Pseudo or Email inconnu / Mot de passe oublié';
            }

        } else {
            $errors['login'] = 'Pseudo or Email inconnu';
        }
    }
}
include('inc/header.php');
?>
    <h1>Connexion</h1>
    <form class="inscri" action="login.php" method="post">
        <label from="login">Pseudo ou email *</label>
        <input type="text" name="login" id="login" value="<?php if (!empty($_POST['login'])) {
            echo $_POST['login'];
        } ?>">
        <p class="error"><?php if (!empty($errors['login'])) {
                echo $errors['login'];
            } ?></p>

        <label from="password">Mot de passe *</label>
        <input type="password" name="password" id="password" value="">
        <p class="error"><?php if (!empty($errors['password'])) {
                echo $errors['password'];
            } ?></p>
        <a href="forgetpsw.php">Mot de passe oublié ?</a>
        <input type="submit" name="submitted" value="Connectez-vous">
    </form>


<?php
include('inc/footer.php');