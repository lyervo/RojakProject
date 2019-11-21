0<?php

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

switch($action){
case 'home':
    $bodyTag = "<body onload='changeColourOnHover()'>";
    include('../view/index.php');
    break;

case 'about':
    $bodyTag = "<body>";
    include('../view/about.php');
    break;

case 'view_recipe':
    $bodyTag = "<body onload='init()'>";
    include('../view/view_recipe.php');
    break;

case 'user_profile':
    $bodyTag = "<body>";
    include('../view/user_profile.php');
    break;

case 'submit_recipe':
    $bodyTag = "<body onload='initTab()'>";
    include ('../view/submit_recipe.php');
    break;

case 'edit_user':
    $bodyTag = "<body>";
    include '../view/edit_user.php';
    break;

case 'logout':
    $bodyTag = "<body>";
    include ('../view/logout.php');
    break;
    
default :
    echo 'action error ' . $action;

}







