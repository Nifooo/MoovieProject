<?php
session_start();
include('inc/pdo.php');
include('function/function.php');
$errors = array();
$title = 'Modification mot de passe';

$sql = "SELECT * FROM users WHERE email = :email AND token = :token";
$query = $pdo->prepare($sql);
$query->bindValue(':email', urldecode($_GET['email']), PDO::PARAM_STR);
$query->bindValue(':token', $_GET['token'], PDO::PARAM_STR);
$query->execute();
$user = $query->fetch();
if (!empty($_POST['submitted'])) {
    $password1 = clean($_POST['password1']);
    $password2 = clean($_POST['password2']);
    if (!empty($password1)) {
        if ($password1 != $password2) {
            $errors['password'] = 'Les 2 mots de passes doivent être identiques !';
        } elseif (mb_strlen($password1) <= 5) {
            $errors['password'] = 'Minimum 6 caractères';
        } elseif (password_verify($password1, $user['password'])) {
            $errors['password'] = 'Vous ne pouvez pas reprendre votre ancien mot de passe';
        }
    } else {
        $errors['password'] = 'Entrez un mot de passe !';
    }
    if (count($errors) == 0) {
        // hash password
        $hashpassword = password_hash($password1, PASSWORD_BCRYPT);
        $token = generateRandomString(200);
        //Insertion en BDD
        $sql = "UPDATE users SET password = :password, token = :token WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email', urldecode($_GET['email']), PDO::PARAM_STR);
        $query->bindValue(':token', $token, PDO::PARAM_STR);
        $query->bindValue(':password', $hashpassword, PDO::PARAM_STR);
        $query->execute();
// Redirection vers connection
        header('Location: login.php');
    }
}
include('inc/header.php'); ?>
    <div class="clear"></div>
    <div class="wrap">
        <h1> Modifier votre mot de passe </h1>
<?php
if (!empty($user)) {
    if (!empty($_GET['email']) && !empty($_GET['token'])) { ?>
        <form action="" method="post">
            <label for="password1"> Nouveau mot de passe : </label>
            <input type="password" name="password1" id="password1" value="">
            <p class="error"><?php if (!empty($errors['password'])) {
                    echo $errors['password'];
                } ?></p>


            <label for="password2"> Confirmez votre mot de passe : </label>
            <input type="password" name="password2" id="password2" value="">

            <input type="submit" name="submitted" value="Modifier">
        </form>
    <?php } else {
        echo 'Error 404';
    }
}
?>  <div class="clear"></div>
    </div><?php
include('inc/footer.php');
