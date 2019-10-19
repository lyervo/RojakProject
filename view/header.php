<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Shop Homepage - Start Bootstrap Template</title>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/shop-homepage.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        
        <script src="../JS/JavaScript.js" type="text/javascript"></script>

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li <?php
                        if ($current == 'home') {
                            echo 'class="current"';
                        }
                        ?> class="nav-item">
                            <a class="nav-link" href="../controller/?action=home">Home</a>
                        </li>
                        <li <?php
                        if ($current == 'about') {
                            echo 'class="current"';
                        }
                        ?> class="nav-item">
                            <a class="nav-link" href="../controller/?action=about">About us</a>
                        </li>
                        <li <?php
                        if ($current == 'contact') {
                            echo 'class="current"';
                        }
                        ?> class="nav-item">
                            <a class="nav-link" href="../controller/?action=contact">Contact</a>
                        </li>
                        
                        
                    </ul>
                </div>
            </div>
        </nav>

