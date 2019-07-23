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
        if ( auth_user( $_POST['user_name'], $_POST['pass'] ) === TRUE )
        {
            $_SESSION['user_name'] = $_POST['user_name'];
            echo "OK";
        }
        else
            echo "Incorrect pasword: $hash";
	}
}
else
	echo "Incomplete Data";
?>
