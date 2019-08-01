<?php
session_start();
include ( "user_management.php" );
if ( isset( $_GET['like'] ) && isset( $_GET['comment'] ) )
{
	if ( $_SESSION['logged_in'] === TRUE )
	{
		if ( update_user_settings($_SESSION['user_name'], $_GET['like'], $_GET['comment']) === TRUE)
			echo "OK";
		else
			echo "CORRUPTED DATABASE! CONTACT THE ADMINISTRATOR IMMEDIATLY";
	}
	else
		echo "ERROR: NO LOGGED IN USER";
}
else if ( isset( $_GET['delete_account'] ) )
{
	
}
else
	echo "MISSING DATA";
?>