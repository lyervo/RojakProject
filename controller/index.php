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

if ($action == 'recipe') {
    include '../view/recipe.php';
}

if ($action == 'contact') {

    include('../view/contact.php');
}

