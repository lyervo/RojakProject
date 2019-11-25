<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Start the session.
 */
if (!isset($_SESSION)) {
    session_start();
}


/**
 * Include ircmaxell's password_compat library.
 */
require '../passJS/password.php';

/**
 * Include our MySQL connection.
 */
require '../model/db_connect.php';


if (isset($_POST['Login'])) {

    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //Retrieve the user account information for the given username.
    $sql = "SELECT user_id, username, password FROM user WHERE username = :username";
    $stmt = $db->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user === false) {

        echo '<div id="login_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>Incorrect username</div>';
    } else {

        $validPassword = password_verify($passwordAttempt, $user['password']);


        if ($validPassword) {

            if (!empty($_POST["remember"])) {
                setcookie("username", $username, time() + (10 * 365 * 24 * 60 * 60));
                setcookie("password", $passwordAttempt, time() + (10 * 365 * 24 * 60 * 60));
            } else {
                setcookie("username", "");
                setcookie("password", "");
            }



            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['login'] = true;

            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            exit;
        } else {

            echo '<div id="login_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>Incorrect password</div>';
        }
    }
}


if (isset($_POST['register'])) {


    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $confirm_password = !empty($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;


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

    if ($row2['num'] > 0) {
        echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>That Username already exists!</div>';
    } 
    else if ($row['num'] > 0) {
        echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>That Email already exists!</div>';
    } 
    else if($username == ""){
        echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>You must Enter a username!</div>';
    }
    else if($email == ""){
        echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>You must Enter an email!</div>';
    }
    else if($password == ""){
        echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>You must Enter a password!</div>';
    }
//    else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
//        echo '<p id="reg_error">You must enter a valid email</p>';
//    }
    else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,12}$/', $password)) {
    echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>Enter the correct password requirements</div>';
}
    else if ($password != $confirm_password) {
        echo '<div id="reg_error"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-exclamation-circle"></i><br><br>Passwords do not match!</div>';
    } 
    else {


        //Hash the password as we do NOT want to store our passwords in plain text.
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

        $sql3 = "INSERT INTO user (email, username, password) VALUES (:email, :username, :password)";
        $stmt3 = $db->prepare($sql3);

        //Bind our variables.
        $stmt3->bindValue(':email', $email);
        $stmt3->bindValue(':username', $username);
        $stmt3->bindValue(':password', $passwordHash);

        $result = $stmt3->execute();


        if ($result) {
            //What you do here is up to you!
            echo '<div id="reg_success"><i style="font-size:4em; margin-top:0.5em;" class="fas fa-check-circle"></i><br><br>Thank you ' . $username . ', for registering with UniMeals.</div>';
        }
    }
}
?>
