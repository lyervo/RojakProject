<?php

function createMailLink($ticket,$user)
{
    $email = '<a onclick="setWarning('.$ticket['ticket_id'].')" href="mailto:'.$user['email'].'?subject=UniMeals Rules Violation&&body=Hello '.$user['username'].',%0d%0a%0d%0a'
            . 'We would like to inform you about a recent rule violation of your content on our website%0d%0a%0d%0a'.$ticket['ticket_type'].'%0d%0a%0d%0a'
            . $ticket['detail'].'%0d%0a%0d%0aPlease edit your content so that it confines to our community rules, failing to comply will'
            . ' result in the deletion of the mentioned content and your account if sufficient strikes has accumulated.%0d%0a%0d%0aWe thank you for your patience'
            . ' and we hope you have a good day.%0d%0a%0d%0aSincerely,%0d%0a%0d%0aUniMeals Admin">Send Mail</a>';
    return $email;
}