<?php

include "../model/db_connect.php";

require 'review_db.php';
require '../user/user_db.php';


$recipe_id = filter_var($_GET['recipe_id'],FILTER_SANITIZE_NUMBER_INT);

$result = getReviews($recipe_id);

    

$response = "";
if (empty($result)) {
    echo 'Be the first one to comment!';
} else {
    foreach ($result as $res) {
        
        $star = "";
        for($i = 0;$i<$res['rating'];$i++)
        {
            $star = $star."<img class='comment_star' src='../images/star_active.png'>";
        }
        
        if($res['rating']<5)
        {
            for($i = 0;$i<5-$res['rating'];$i++)
            {
                $star = $star."<img class='comment_star' src='../images/star_inactive.png'>";
            }
        }
        
        $user = getUserByID($res['user_id']);

        if ($user['user_image'] == null) {
             $response = $response . "<div id='one_comment'><div id='comment_context'><a id='review_" . $res['review_id'] . "'href='?action=user_profile&user_id=" . $user['user_id'] . "'><img id='default_profile' src='../images/fbp.jpg' height='24px' width='24px' />&nbsp" . $user['username'] . "</a><p>".$star."</p><p>" . $res['comment'] . "</p><i id='comment_date'>" . $res['review_date'] . "</i><br><button id='report_button' onclick='initReport(" . $res['review_id'] . ")'><a role='button' data-toggle='modal' data-target='#report_tab' ><i class='fas fa-flag'></i>&nbspReport</a></button></div></div><br>";
            
        } else {
            $response = $response . "<div id='one_comment'><div id='comment_context'><a id='review_" . $res['review_id'] . "'href='?action=user_profile&user_id=" . $user['user_id'] . "'><img id='profile_picture' src='data:image/jpeg;base64," . base64_encode($user['user_image']) . "' height='24px' width='24px'/>&nbsp" . $user['username'] . "</a><p>".$star."</p><p id='comment'>" . $res['comment'] . "</p><i id='comment_date'>" . $res['review_date'] . "</i><br><button id='report_button' onclick='initReport(" . $res['review_id'] . ")'><a role='button' data-toggle='modal' data-target='#report_tab' ><i class='fas fa-flag'></i>&nbspReport</a></button></div></div><br>";

        }


       
    }
    echo $response;
}
    
