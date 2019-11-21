<?php

include "../model/db_connect.php";

require 'review_db.php';
require '../user/user_db.php';


$recipe_id = $_REQUEST['recipe_id'];

$result = getReviews($recipe_id);

$response = "";
if (empty($result)) {
    echo 'Be the first one to comment!';
} else {
    foreach ($result as $res) {
        $user = getUserByID($res['user_id']);

        if ($user['user_image'] == null) {
             $response = $response . "<div id='one_comment'><a id='review_" . $res['review_id'] . "'href='?action=user_profile&user_id=" . $user['user_id'] . "'><img id='default_profile' src='../images/fbp.jpg' height='24px' width='24px' />&nbsp" . $user['username'] . "</a><p>" . $res['comment'] . "</p><i>" . $res['review_date'] . "</i><br><button onclick='initReport(" . $res['review_id'] . ")'><a role='button' data-toggle='modal' data-target='#report_tab' >Report</a></button></div><br>";
            
        } else {
            $response = $response . "<div id='one_comment'><a id='review_" . $res['review_id'] . "'href='?action=user_profile&user_id=" . $user['user_id'] . "'><img id='profile_picture' src='data:image/jpeg;base64," . base64_encode($user['user_image']) . "' height='24px' width='24px'/>&nbsp" . $user['username'] . "</a><p id='comment'>" . $res['comment'] . "</p><i>" . $res['review_date'] . "</i><br><button onclick='initReport(" . $res['review_id'] . ")'><a role='button' data-toggle='modal' data-target='#report_tab' >Report</a></button></div><br>";

        }


       
    }
    echo $response;
}
    
