<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Start the session.
 */

if(!isset($_SESSION))
{
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


if (isset($_POST['Login'])) 
{

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

    //If $row is FALSE.
    if ($user === false) {
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        echo '<p id="error">Incorrect username</p>';
    } else {
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        echo '<p id="error">here</p>';
        //If $validPassword is TRUE, the login has been successful.
        if ($validPassword) {

            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['login'] = true;

//            //Redirect to our protected page, which we called home.php
//            header('Location: ../controller/?action=login_index');
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            exit;
        } else {
            //$validPassword was FALSE. Passwords do not match.
            echo '<p id="error">Incorrect password</p>';
        }
    }
}

//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if (isset($_POST['register'])) {

    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;

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
        $sql3 = "INSERT INTO user (email, username, password) VALUES (:email, :username, :password)";
        $stmt3 = $db->prepare($sql3);

        //Bind our variables.
        $stmt3->bindValue(':email', $email);
        $stmt3->bindValue(':username', $username);
        $stmt3->bindValue(':password', $passwordHash);

        //Execute the statement and insert the new account.
        $result = $stmt3->execute();

        //If the signup process is successful.
        if ($result) {
            //What you do here is up to you!
            echo '<p id="success">Thank you ' . $username . ', for registering with our website.</p>';
        }
    }
}

?>
