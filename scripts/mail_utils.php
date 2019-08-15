<?php
function send_token($first_name, $last_name, $address, $token)
{
    $to = $address;
    $from = "camagrusmtpltd@gmail.com";
    $subject = "Confirm Your Account";
    $message = $first_name . " " . $last_name . " here is your token:" . "\n\n" . $token;
    $message .= "\n\n" . "Please click on the following link to verify your account: " . "\n\n";
    $message .= "https://192.168.99.100/index.php?login=verify&token=" . $token;

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}

function send_like_notif($address)
{
    $to = $address;
    $from = "camagrusmtpltd@gmail.com";
    $subject = "Activity in Your Creations";
    $message = "Somebody liked your creation!";

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}

function send_comment_notif($address)
{
    $to = $address;
    $from = "camagrusmtpltd@gmail.com";
    $subject = "Activity in Your Creations";
    $message = "Somebody commented on your creation!";

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}

function send_password_reset($address, $token)
{
    $to = $address;
    $from = "camagrusmtpltd@gmail.com";
    $subject = "Confirm Your Account";
    $message .= "\n\n" . "Please click on the following link to reset your password: " . "\n\n";
    $message .= "https://192.168.99.100/index.php?login=reset&token=" . $token;

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);
}
?>