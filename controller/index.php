<?php

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

if ($action == 'home') {

    include('../view/index.php');
}

if ($action == 'about') {

    include('../view/about.php');
}

if ($action == 'view_recipe'){
    include('../view/view_recipe.php');
}

if ($action == 'user_profile'){
    include('../view/user_profile.php');
}

if ($action == 'contact') {

    include('../view/contact.php');
}

if ($action == 'login') {

    include('../view/login.php');
}

