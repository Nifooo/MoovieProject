<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Mot de passe oublié';
$errors = array();
$succes = false;
if (!empty($_POST['submitted'])){
    //faille xss
    $email = clean($_POST['email']);
    $sql ="SELECT email,token FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $user =$query->fetch();
    if (!empty($user)){
        //die('ok');
        $token = $user['token'];
        $email = urlencode($email);
        $html = '<a href="modifpsw.php?token='. $token . '&email=' . $email . '">Here</a>';
        echo $html;
        //debug($html);



    }else{
        $errors['email'] = 'Prend moi pour une bite !';
    }
}
include('inc/header.php');
?>
    <h1>Mot de passe oublié</h1>
    <form method="post" action="forgetpsw.php">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])){echo $_POST['email'];}?>">
        <p class="error"><?php if (!empty($errors['email'])) {
                echo $errors['email'];
            } ?></p>
        <input type="submit" name="submitted" value="modifier votre mot de passe">
    </form>

<?php
include('inc/footer.php');