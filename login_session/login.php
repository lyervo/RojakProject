<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require '../passJS/password.php';

/**
 * Include our MySQL connection.
 */
include '../model/db_connect.php';


//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.


?>
