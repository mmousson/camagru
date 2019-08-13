<?php
function send_token($first_name, $last_name, $address, $token)
{
    $to = $address;
    $from = "root@camagru.fr"; // this is the sender's Email address
    $subject = "Confirm Your Account";
    $message = $first_name . " " . $last_name . " here is your token:" . "\n\n" . $token;

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}

function send_like_notif($address)
{
    $to = $address;
    $from = "root@camagru.fr"; // this is the sender's Email address
    $subject = "Activity in Your Creations";
    $message = "Somebody liked your creation!";

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}

function send_comment_notif($address)
{
    $to = $address;
    $from = "root@camagru.fr"; // this is the sender's Email address
    $subject = "Activity in Your Creations";
    $message = "Somebody commented on your creation!";

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}
?>