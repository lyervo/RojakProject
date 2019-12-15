<!DOCTYPE html>
<?php
include '../login_session/session.php';
include '../user/user_db.php';

if (isset($_SESSION['user_id'])) {
    $userl = getUserByIDPicture($_SESSION['user_id']);
    $user = getUserByID($_SESSION['user_id']);
}
?>
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
        <link href="../css/about.css" rel="stylesheet" type="text/css"/>
        
        
        <!-- FAVICON -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
        
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!--login-->
        <script src="../JS/login.js" type="text/javascript"></script>
        <link href="../css/report_recipe_modal.css" rel="stylesheet" type="text/css"/>
        <link href="../css/report_comment_modal.css" rel="stylesheet" type="text/css"/>
        <link href="../css/login_style.css" rel="stylesheet" type="text/css"/>


        <!-- Custom styles for this template -->
        <link href="../css/shop-homepage.css" rel="stylesheet">
        <link href="../css/boxs.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli:700&display=swap" rel="stylesheet">

       


    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v5.0"></script>

</head>

<?php
echo $bodyTag;
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
    <div class="container">
        <a class="navbar-brand" id="web_title" href="?action=home">UniMeals</a>
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
                <?php
                if (isset($_SESSION['user_id']) && $userl['user_image'] == null) {
                    echo '<li ';
                    if($current == "user"){
                        echo 'class="current"';
                    }  
                    echo 'class="nav-item-user">
                                <div class="dropdown">
                                <a class="nav-link" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="default_profile" src="../images/fbp.jpg" height="22px" width="22px" />&nbsp;<i class="fas fa-sort-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../controller/?action=user_profile&user_id=' . $_SESSION['user_id'] . '">View Profile</a>
                                    <a class="dropdown-item" href="../controller/?action=submit_recipe">Upload A Recipe</a>';
                    
                    if($user['admin']==1)
                    {
                      
                        echo '<a class="dropdown-item" href="?action=admin_page">Admin Page</a>';
                             
                    }
                    
                    echo '
                                    <a class="dropdown-item" href="?action=logout">Logout</a>
                                </div>
                            </div>
                            </li>';
                } else if (isset($_SESSION['user_id']) && $userl['user_image'] != null) {
                    
                    echo '<li ';
                    if($current == "user"){
                        echo 'class="current"';
                    }  
                    echo 'class="nav-item-user">
                                <div class="dropdown">
                                <a class="nav-link" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="profile_picture" src="data:image/jpeg;base64,' . base64_encode($userl['user_image']) . '" height="22px" width="22px"/>&nbsp;<i class="fas fa-sort-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="../controller/?action=user_profile&user_id=' . $_SESSION['user_id'] . '">View Profile</a>
                                    <a class="dropdown-item" href="../controller/?action=submit_recipe">Upload A Recipe</a>';
                                    
                    if($user['admin']==1)
                    {
                      
                        echo '<a class="dropdown-item" href="?action=admin_page">Admin Page</a>';
                             
                    }

                    echo '<a class="dropdown-item" href="?action=logout">Logout</a>
                                </div>
                            </div>
                            </li>';
                } else {
                    echo '<li class="nav-item">
                                <a class="nav-link" id="login_button" role="button" data-toggle="modal" data-target="#login-modal">Login/Sign Up</a>
                            </li>';
                }
                ?>
                





            </ul>
        </div>
    </div>
</nav>




<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="../images/logo.jpg">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true"> <i class="fas fa-times"></i></span>
                </button>
            </div>

            <!-- Begin # DIV Form -->
            <div id="div-forms">

                <!-- Begin # Login Form -->
                <form action="" method="post" id="login-form">
                    <div class="modal-body">
                        <h4 id="form_title">Login</h4>

                        <input  id="login_username" class="form-control" type="text" name="username" value="<?php
                        if (isset($_COOKIE["username"])) {
                            echo $_COOKIE["username"];
                        }
                        ?>" placeholder="Username" required>               
                        <input id="login_password" class="form-control" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" value="<?php
                        if (isset($_COOKIE["password"])) {
                            echo $_COOKIE["password"];
                        }
                        ?>" placeholder="Password" required>
                        <div class="checkbox">
                            <label>
                                <input  type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE["username"])) { ?> checked <?php } ?>> Remember me
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <input type="submit" name="Login" value="Login" class="btn btn-primary">
                        </div>
                        <div>       
                            <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                        </div>
                    </div>
                </form>
                <!-- End # Login Form -->

                
                <!-- Begin | Register Form -->
                <form action="" method="post" id="register-form" style="display:none;">
                    <div class="modal-body">

                        <h4 id="form_title">Register an account</h4>
                        <input id="register_username" class="form-control" type="text" name="username" placeholder="Username" value="<?php if (isset($_POST['username'])){$user = $_POST['username']; echo $user;}?>" required/>
                        
                        <input id="register_email" class="form-control" type="email" name="email" placeholder="E-Mail" value="<?php if (isset($_POST['email'])){$email = $_POST['email']; echo $email;}?>" required/>
                        <input id="register_password" class="form-control" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" required/>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be 8-20 characters long, contain Uppercase and Lowercase letters and numbers, and must not contain spaces or special characters.
                        </small>
                        <input id="register_password" class="form-control" type="password" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Password" required/>
                        
                    </div>
                    <div class="modal-footer">
                        <div>
                            <input type="submit" name="register" value="Register" class="btn btn-success">

                        </div>
                        <div>
                            <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                        </div>
                    </div>
                </form>
                <!-- End | Register Form -->

            </div>
            <!-- End # DIV Form -->

        </div>
    </div>
</div>



