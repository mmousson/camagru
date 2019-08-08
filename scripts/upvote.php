<?php
session_start();
include_once ( "pdo_connect.php" );

if ( $_SESSION['logged_in'] === TRUE )
{
    $conn = pdo_connect( "__camagru_posts" );
    if ( $conn !== NULL )
    {
        $query = $conn->prepare("SELECT like_dir FROM likes WHERE (author='" . $_SESSION['user_name'] . "' AND image_id='" . $_GET['image_id'] . "')");
        $query->execute();

        $result = $query->fetch();
        if ( empty( $result ) ) //The user has never liked or disliked this post before, create a new Database entry
        {
            $query = $conn->prepare("INSERT INTO likes
                                    (
                                        image_id,
                                        author,
                                        like_dir
                                    )
                                    VALUES
                                    (
                                        :image_id,
                                        :author,
                                        :like_dir
                                    )");
            $query->bindParam(':image_id', $_GET['image_id']);
            $query->bindParam(':author', $_SESSION['user_name']);
            $query->bindParam(':like_dir', $_GET['like']);
            $query->execute();
        }
        else //The user has already liked or disliked this post before, update the Database entry
        {
            $query = $conn->prepare("UPDATE likes SET like_dir=:like_dir WHERE image_id=:image_id AND author=:author");
            $query->bindParam(':like_dir', $_GET['like']);
            $query->bindParam(':image_id', $_GET['image_id']);
            $query->bindParam(':author', $_SESSION['user_name']);
            $query->execute();
        }
        $conn = NULL;
        echo "OK";
    }
}
else
    echo "ERROR: You must be logged in to like or comment";
?>