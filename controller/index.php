<?php

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

switch($action){
case 'home':
    include('../view/index.php');
    break;

case 'about':
    include('../view/about.php');
    break;

case 'view_recipe':
    include('../view/view_recipe.php');
    break;

case 'user_profile':
    include('../view/user_profile.php');
    break;

////////////////////// LOGIN //////////////////////////////// 

case 'login_index':
    include '../login_view/index.php';
    break;

case 'logout':
    include '../login_view/logout.php';
    break;

case 'profile':
    include '../login_view/user_profile.php';
    break;

case 'view_recipe_login':
    include '../login_view/view_recipe.php';
    break;

default :
    echo 'action error ' . $action;

}





