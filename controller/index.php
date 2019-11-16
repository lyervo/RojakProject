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

case 'submit_recipe':
    include ('../view/submit_recipe.php');
    break;

case 'edit_user':
    include '../view/edit_user.php';
    break;

case 'logout':
    include ('../view/logout.php');
    break;
    
default :
    echo 'action error ' . $action;

}





