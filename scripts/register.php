<?php
include_once ( "mail_utils.php" );
require_once ( "user_management.php" );
if (isset($_POST['mobile']) && isset($_POST['mail']) && isset($_POST['full_name']) && isset($_POST['user_name'])
	&& isset($_POST['pass']) && isset($_POST['repass']))
{
	if ($_POST['mobile'] === "" || $_POST['mail'] === "" || $_POST['full_name'] === "" || $_POST['user_name'] === ""
		|| $_POST['pass'] === "" || $_POST['repass'] === "")
		echo "Please fill out all fields";
	else if (check_if_exists($_POST['user_name'], "login") === TRUE)
		echo "Username already exists";
	else if (check_if_exists($_POST['mail'], "mail") === TRUE)
		echo "e-mail is already in use";
	else if (check_if_exists($_POST['mobile'], "phone") === TRUE)
		echo "Phone number is already in use";
	else if (strcmp($_POST['pass'], $_POST['repass']) !== 0)
		echo "Passwords do not match";
	else if (strlen($_POST['pass']) < 6)
		echo "Password must be at leat 6 characters-long";
	else if (strlen($_POST['user_name']) < 6)
		echo "Username must be at leat 6 characters-long";
	else if (strlen($_POST['mobile']) < 10)
		echo "Please provide a valid phone number";
	else if (strpos($_POST['mail'], "@") === FALSE)
		echo "Please provide a valid mail address";
	else
	{
		$token = add_user($_POST['mobile'], $_POST['mail'], $_POST['full_name'], $_POST['user_name'], $_POST['pass']);
		if ( $token !== NULL )
			send_token($_POST['full_name'], $_POST['user_name'], $_POST['mail'], $token);
	}
}
else
	echo "Incomplete Data";
?>
