<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>UniMeals</title>



        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="../css/footer.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!--login-->
        <script src="../JS/login.js" type="text/javascript"></script>
        <link href="../css/login_style.css" rel="stylesheet" type="text/css"/>

        <!-- Custom styles for this template -->
        <link href="../css/shop-homepage.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>

        <script src="../JS/login_search.js" type="text/javascript"></script>

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
            <div class="container">
                <a class="navbar-brand" href="?action=home">UniMeals</a>
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
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="../controller/?action=contact"><i style="text-decoration: none; color: white; font-size: 1.3em;" class="fas fa-user-circle"></i>&nbsp;<i class="fas fa-sort-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../controller/?action=profile">Profile</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="../controller/?action=logout">Logout</a>
<!--                                    <form method='post' action="">
                                        <input id="but_logout" type="submit" value="Logout" name="but_logout">
                                    </form>-->
                                </div>
                            </div>
                        </li>





                    </ul>
                </div>
            </div>
        </nav>






