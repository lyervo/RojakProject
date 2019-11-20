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

        echo '<p id="login_error">Incorrect username</p>';
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

            echo '<p id="login_error">Incorrect password</p>';
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
        echo '<p id="reg_error">That Username already exists!</p>';
    } 
    else if ($row['num'] > 0) {
        echo '<p id="reg_error">That Email already exists!</p>';
    } 
    else if($username == ""){
        echo '<p id="reg_error">You must Enter a username!</p>';
    }
    else if($email == ""){
        echo '<p id="reg_error">You must Enter an email!</p>';
    }
    else if($password == ""){
        echo '<p id="reg_error">You must Enter a password!</p>';
    }
    elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
        echo '<p id="reg_error">You must enter a valid email</p>';
    }
    else if ($password != $confirm_password) {
        echo '<p id="reg_error">Passwords do not match!</p>';
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
            echo '<p id="reg_success">Thank you ' . $username . ', for registering with UniMeals.</p>';
        }
    }
}
?>
