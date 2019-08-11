<?php
session_start();
include_once ( "pdo_connect.php" );

function	is_author_or_root( $conn, $delete_type, $id )
{
	$result = array();

	if ( strcmp( $_SESSION['user_name'], "root" ) === 0 )
		return ( TRUE );
	else if ( strcmp( $delete_type, "check" ) === 0
		|| strcmp( $delete_type, "post" ) === 0 )
	{
		$query = $conn->prepare("SELECT author FROM publications WHERE id=:id");
		$query->bindParam(':id', $id);
		$query->execute();

		$result = $query->fetch();
	}
	else if ( strcmp( $delete_type, "comment" ) === 0 )
	{
		$query = $conn->prepare("SELECT author FROM comments WHERE comment_id=:comment_id");
		$query->bindParam(':comment_id', $id);
		$query->execute();

		$result = $query->fetch();
	}
	if ( strcmp( $_SESSION['user_name'], $result['author'] ) === 0 )
		return ( TRUE );
	else
		return ( FALSE );
}

$message = "";
if ( strcmp( $_GET['delete_type'], "check" ) === 0 )
{
	$message = "";
	$conn = pdo_connect( "__camagru_posts" );

	if ( is_author_or_root( $conn, $_GET['delete_type'], $_GET['image_id'] ) === TRUE )
		$message .= "OK";
	else
		$message .= "DENIED";
	$conn = NULL;
	echo $message;
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
				$message .= "ERROR: Couldn't delete the image file related to that post. You should do it manually" . PHP_EOL;
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
	if ( $message === "" )
		echo "OK";
	else
		echo $message;
}
else if ( strcmp( $_GET['delete_type'], "profile" ) === 0 )
{
	$conn = pdo_connect( "__camagru_users" );

	if ( $conn !== NULL)
	{
		if ( is_author_or_root( $conn, $_GET['delete_type'], $_GET['user_id'] ) !== TRUE )
			$message .= "ERROR: You are not authorized to perform this action. This incident will be reported" . PHP_EOL;
		else
		{
			$sql = "DELETE FROM account_infos WHERE id='" . $_GET['user_id'] . "'";
			$conn->exec($sql);
			$conn = NULL;
		}
	}
	else
		$message .= "ERROR: Couldn't connect to the database" . PHP_EOL;
	if ( $message === "" )
		echo "OK";
	else
		echo $message;
}
?>
