<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Home Page';
debug($_SESSION);
include('inc/header.php');
?>
    <h1>Home</h1>

<?php
include('inc/footer.php');
