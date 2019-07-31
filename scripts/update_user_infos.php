<?php
session_start();
include ( "user_management.php" );
if ( isset( $_GET['username'] ) && !empty( $_GET['username'] )
	&& isset( $_GET['mail'] ) && !empty( $_GET['mail'] )
	&& isset( $_GET['oldpass'] ) && !empty( $_GET['oldpass'] )
	&& isset( $_GET['newpass'] )
	&& isset( $_GET['repass'] ) )
{
	if ( $_SESSION['logged_in'] === TRUE )
	{
		$ret = update_user_infos( $_SESSION['user_name'],
			$_GET['username'],
			$_GET['mail'],
			$_GET['oldpass'],
			$_GET['newpass'],
			$_GET['repass'] );
		if ( $ret === 0 )
		{
			$_SESSION['user_name'] = $_GET['username'];
			echo "OK";
		}
		else if ( $ret === 1 )
			echo "Incorrect Old Password";
		else if ( $ret === 2)
			echo "New Password does not match password confirmation";
		else if ( $ret === 3 )
			echo "Username already exists!";
		else if ( $ret === 4 )
			echo "e-mail is already being used!";
		else
			echo "ERROR: Corrupted Database! Contact an administrator immediatly";
	}
	else
		echo "ERROR: No logged in user";
}
else
	echo "Incomplete Data";
?>