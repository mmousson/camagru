<?php
function    send_token($addr, $token)
{
    $to      = $addr;
    $subject = 'Camagru - Confirm your Account';
    $message = 'Hello !\r\nThank you for joining us at Camagru.\r\nHere you will find the confirmation link to activate your account:\r\n\r\nhttp:/camagru.com/confirm.php?token=$token';
    $headers = 'From: no-reply@camagru.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}
?>