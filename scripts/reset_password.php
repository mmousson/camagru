<?php
session_start();
include_once ( "pdo_connect.php" );
include_once ( "mail_utils.php" );
include_once ( "user_management.php" );

$conn = pdo_connect( "__camagru_users" );
if ( $conn !== NULL )
{
    if ( isset( $_GET['login'] ) && isset( $_GET['mail'] ) )
    {
        if ( !empty( $_GET['login'] ) && !empty( $_GET['mail'] ) )
        {
            $token = generate_token();
            $query = $conn->prepare("UPDATE account_infos SET token=:token WHERE login=:login AND mail=:mail");
            $query->bindParam(':token', $token);
            $query->bindParam(':login', $_GET['login']);
            $query->bindParam(':mail', $_GET['mail']);
            $query->execute();

            if ( $query->rowCount() !== 0 )
                send_password_reset($_GET['mail'], $token);
            echo "OK";
        }
        else
            echo "Please fill out all fields";
    }
    else if ( isset( $_GET['new_pass'] ) && isset( $_GET['re_new_pass'] ) )
    {
        if ( !empty( $_GET['new_pass'] ) && !empty( $_GET['re_new_pass'] ) )
        {
            if ( strlen( $_GET['new_pass'] ) < 6 )
                echo "Password must be at least 6 characters long";
            else
            {
                if ( strcmp( $_GET['new_pass'], $_GET['re_new_pass']) !== 0 )
                    echo "Passwords do not match";
                else
                {
                    $password_hash = hash("whirlpool", $_GET['new_pass']);
                    $query = $conn->prepare("UPDATE account_infos SET password_hash=:password_hash, token='NULL' WHERE token=:token");
                    $query->bindParam(':password_hash', $password_hash);
                    $query->bindParam(':token', $_SESSION['token']);
                    $query->execute();
                    echo "OK";
                }
            }
        }
        else
            echo "Please fill out all fields";
    }
    else
        echo "Incomplete Data";
    $conn = NULL;
}
else
    echo "Can't connect to database";
?>
