<?php
session_start();
include_once ( "pdo_connect.php" );

if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) )
{
    $conn = pdo_connect( "__camagru_posts" );
    if ( $conn !== NULL )
    {
        $query = $conn->prepare("SELECT like_dir FROM likes WHERE image_id=:image_id AND author=:author");
        $query->bindParam(':image_id', $_GET['id']);
        $query->bindParam(':author', $_SESSION['user_name']);
        $query->execute();

        $results = $query->fetch();
        echo $results[0];
        $conn = NULL;
    }
    else
        echo "ERROR: Couldn't connect to database";
}
else
    echo "ERROR: Missing Data";
?>