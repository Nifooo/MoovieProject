<?php
session_start();
require('inc/pdo.php');
require('function/function.php');
$title = 'Pannel Admin';
$errors = array();
$succes = false;
if (!idAdmin()) {header("Location: 403.html");} ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pannel Admin</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assetsAdmin/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assetsAdmin/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assetsAdmin/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
<div id="wrapper">

    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li>
                    <a href="index.php" ><i class="fa fa-qrcode "></i>Accueil</a>
                </li>

                <li>
                    <a href="addMovie.php" ><i class="fa fa-qrcode "></i>Ajouter un film</a>
                </li>


            </ul>
        </div>

    </nav>

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Accueil Admin</h2>
                </div>
            </div>

            <hr />
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="alert alert-info">
                        <strong>Bienvenue aux administrateurs</strong>
                    </div>

                </div>
            </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="manageUsers.php" >
                            <i class="fa fa-users fa-5x"></i>
                            <h4>Voir les utilisateurs</h4>
                        </a>
                    </div>


                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <div class="div-square">
                    <a href="seeFilmAdmin.php" >
                        <i class="fa fa-user fa-5x"></i>
                        <h4>Voir la liste des films</h4>
                    </a>
                </div>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <div class="div-square">
                    <a href="manageFilm.php" >
                        <i class="fa fa-user fa-5x"></i>
                        <h4>Modifier les films</h4>
                    </a>
                </div>

            </div>



            </div>
            </div>

    </div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assetsAdmin/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assetsAdmin/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assetsAdmin/js/custom.js"></script>


    </body>




<?php


include('inc/footer.php');
