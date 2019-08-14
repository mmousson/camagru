<?php
session_start();
include_once ( "pdo_connect.php" );
include_once ( "mail_utils.php" );

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

            if ( strcmp( $_GET['like'], "1" ) === 0 )
                $query = $conn->prepare("UPDATE publications SET likes = likes + 1 WHERE id=:id");
            else
                $query = $conn->prepare("UPDATE publications SET likes = likes - 1 WHERE id=:id");
            $query->bindParam(':id', $_GET['image_id']);
            $query->execute();
        }
        else //The user has already liked or disliked this post before, update the Database entry
        {
            $query = $conn->prepare("SELECT like_dir FROM likes WHERE image_id=:image_id AND author=:author");
            $query->bindParam(':image_id', $_GET['image_id']);
            $query->bindParam(':author', $_SESSION['user_name']);
            $query->execute();

            $previous = intval( $query->fetch()[0] );
            $query = NULL;
            if ( $previous == 1  && intval( $_GET['like'] ) == -1 )
                $query = $conn->prepare("UPDATE publications SET likes = likes - 2 WHERE id=:id");
            else if ( $previous == -1 && intval( $_GET['like'] ) == 1 )
                $query = $conn->prepare("UPDATE publications SET likes = likes + 2 WHERE id=:id");
            if ( $query !== NULL )
            {
                $query->bindParam(':id', $_GET['image_id']);
                $query->execute();
            }

            $query = $conn->prepare("UPDATE likes SET like_dir=:like_dir WHERE image_id=:image_id AND author=:author");
            $query->bindParam(':like_dir', $_GET['like']);
            $query->bindParam(':image_id', $_GET['image_id']);
            $query->bindParam(':author', $_SESSION['user_name']);
            $query->execute();
        }

        //Either way, notify the author of the post
        $query = $conn->prepare("SELECT author FROM publications WHERE id=:id");
        $query->bindParam(':id', $_GET['image_id']);
        $query->execute();
        
        $author_name = $query->fetch()[0];

        $query = $conn->prepare("SELECT mail, like_notif FROM __camagru_users.account_infos WHERE login=:login");
        $query->bindParam(':login', $author_name);
        $query->execute();

        $result = $query->fetch();
        if ( intval( $result['like_notif'] ) == 1 )
            send_like_notif( $result['mail'] );
        $conn = NULL;
        echo "OK ";
    }
}
else
    echo "ERROR: You must be logged in to like or comment";
?>
