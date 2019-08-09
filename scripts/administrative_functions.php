<?php
session_start();
include_once ( "pdo_connect.php" );

function	is_author_or_root()
{
	return ( TRUE );
}

$message = "";
if ( strcmp( $_GET['delete_type'], "none" ) === 0 )
{

}
else if ( strcmp( $_GET['delete_type'], "post" ) === 0)
{
	$conn = pdo_connect( "__camagru_posts" );

	if ( $conn !== NULL )
	{
		if ( is_author_or_root( $conn, $_GET['delete_type'], $_GET['image_id'] ) !== TRUE )
			$message .= "ERROR: You are not authorized to perform this action. This incident will be reported" . PHP_EOL;
		else
		{
			$sql = "DELETE FROM publications WHERE id='" . $_GET['image_id'] . "'";
			$conn->exec($sql);
			$conn = NULL;

			$image_path = "../posts/" . $_GET['image_id'] . ".png";
			if ( unlink( $image_path ) === FALSE )
				$message .= "ERROR: Couldn't the image file related to that post. You should do it manually" . PHP_EOL;
		}
	}
	else
		$message .= "ERROR: Couldn't connect to the database" . PHP_EOL;
	if ( $message === "" )
		echo "OK";
	else
		echo $message;
}
else if ( strcmp( $_GET['delete_type'], "comment" ) === 0 )
{
	$conn = pdo_connect( "__camagru_posts" );

	if ( $conn !== NULL )
	{
		if ( is_author_or_root( $conn, $_GET['delete_type'], $_GET['comment_id'] ) !== TRUE )
			$message .= "ERROR: You are not authorized to perform this action. This incident will be reported" . PHP_EOL;
		else
		{
			$sql = "DELETE FROM comments WHERE comment_id='" . $_GET['comment_id'] . "'";
			$conn->exec( $sql );
			$conn = NULL;
		}
	}
	else
		$message .= "ERROR: Couldn't connect to the database" . PHP_EOL;
}
else if ( strcmp( $_GET['delete_type'], "profile" ) === 0 )
{
	$conn = pdo_connect( "__camagru_users" );

	if ( $conn !== NULL)
	{
		if ( is_author_or_root( $conn, $_GET['delete_type'], $_GET['comment_id'] ) !== TRUE )
			$message .= "ERROR: You are not authorized to perform this action. This incident will be reported" . PHP_EOL;
		else
		{

		}
	}
	else
		$message .= "ERROR: Couldn't connect to the database" . PHP_EOL;
}
?>
