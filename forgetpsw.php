<?php

include('inc/pdo.php');
include('function/function.php');

$title = 'Mot de passe oublié';
$errors = array();
$success = false;

if (!empty($_POST['submitted'])){
    $email = clean($_POST['email']);
    $sql = "SELECT email, token FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (!empty($user)){
        $token = $user['token'];
        $email = urlencode($email);
        $html = '<a href="modifpsw.php?email=' . $email . '&token=' . $token . '">C\'est ici</a>';
        echo $html;
    } else {
        $errors['email'] = 'Prends moi pour un con';
    }
}

include('inc/header.php'); ?>
    <div class="wrap">
        <div class="clear"></div>
        <h1> Mot de passe oublié </h1>

        <form class="inscri" action="" method="post">
            <label for="email">E-mail : </label>
            <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])) {
                echo $_POST['email'];
            } ?>">
            <p class="error"><?php if (!empty($errors['email'])) {
                    echo $errors['email'];
                } ?></p>

            <input type="submit" name="submitted" value="Modifier mon mot de passe">
        </form>
        <div class="clear"></div>
    </div>
<?php include('inc/footer.php');