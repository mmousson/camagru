<?php
session_start();
require_once( "user_management.php" );
if (isset($_POST['user_name']) && isset($_POST['pass']))
{
	if ($_POST['user_name'] === "" || $_POST['pass'] === "")
		echo "Please fill out all fields";
	else if (check_if_exists($_POST['user_name'], "login") === FALSE)
		echo "Unknown username";
	else
	{
        $hash = hash("whirlpool", $_POST['pass']);
        //0 -> Incorrect password
        //1 -> Account not yet verified
        //2 -> OK
        $ret = auth_user( $_POST['user_name'], $_POST['pass'] );
        if ( $ret === 0 )
            echo "Incorrect password";
        else if ( $ret === 1 )
            echo "You first need to verify your account";
        else if ( $ret === 2 )
        {
            $_SESSION['logged_in'] = TRUE;
            $_SESSION['user_name'] = $_POST['user_name'];
            echo "OK";
        }
        else
            echo "Unknown error";
	}
}
else
	echo "Incomplete Data";
?>
