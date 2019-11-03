<?php
//register.php

/**
 * Start the session.
 */
session_start();

/**
 * Include ircmaxell's password_compat library.
 */
require 'passJS/password.php';

/**
 * Include our MySQL connection.
 */
require 'model/db_connect.php';


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if (isset($_POST['register'])) {

    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
    
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    //Now, we need to check if the supplied username already exists.
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(email) AS num FROM user WHERE email = :email";
    $sql2 = "SELECT COUNT(username) AS num FROM user WHERE username = :username";

    $stmt = $db->prepare($sql);
    $stmt2 = $db->prepare($sql2);

    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':email', $email);
    $stmt2->bindValue(':username', $username);

    //Execute.
    $stmt->execute();
    $stmt2->execute();

    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if ($row2['num'] > 0) {
        echo '<p id="reg_error">That username already exists!</p>';
    } else if ($row['num'] > 0) {
        echo '<p id="reg_error">That email already exists!</p>';
    } else {


        //Hash the password as we do NOT want to store our passwords in plain text.
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql3 = "INSERT INTO user VALUES (null,:username,:email,:password,:gender,0)";
        $stmt3 = $db->prepare($sql3);

        //Bind our variables.
        $stmt3->bindValue(':email', $email);
        $stmt3->bindValue(':username', $username);
        $stmt3->bindValue(':password', $passwordHash);
        $stmt3->bindValue(':gender', $gender);

        //Execute the statement and insert the new account.
        $result = $stmt3->execute();

        //If the signup process is successful.
        if ($result) {
            //What you do here is up to you!
            echo '<p id="success">Thank you ' . $username . ', for registering with our website.</p>';
        }
    }
}


//$username = $_POST['username'];
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

    <head>
        <title>My Awesome Login Page</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link href="css/login_style.css" rel="stylesheet" type="text/css"/>
    </head>
    <!--Coded with love by Mutiullah Samim-->
    <body>
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="images/logo.jpg" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form action="register.php" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" required id="email" name="email" class="form-control input_user" value="" placeholder="email">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" required id="username" name="username"  class="form-control input_user"  placeholder="username">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" required id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control input_pass"  placeholder="password">
                            </div>
                            
                            <div class="input-group mb-3">
                                Gender:&nbsp;&nbsp;&nbsp;&nbsp;
                                <select id="selectGender" name="gender">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">I Accept the <a href="https://tripadvisor.mediaroom.com/ie-terms-of-use">Terms of Use</a> and our <a href="https://tripadvisor.mediaroom.com/ie-privacy-policy">Privacy Policy</a> of UniMeals</label>
                                </div>
                            

                            <div class="d-flex justify-content-center mt-3 login_container">
                                <input type="submit" name="register" value="Register" class="btn login_btn">
                            </div>


                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            <a href="login.php" class="ml-2">Back to Login Page</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
