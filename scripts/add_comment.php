<?php
session_start();
include_once ( "pdo_connect.php" );

if ( isset( $_GET['image_id'] ) && !empty( $_GET['image_id'] )
    && isset ( $_GET['message'] ) && !empty( $_GET['message'] ) )
{
    if ( $_SESSION['logged_in'] === TRUE )
    {
        $conn = pdo_connect( "__camagru_posts" );
        if ( $conn !== NULL )
        {
            $author = $_SESSION['user_name'];
            $date = date("Y-m-d H:i:s");
            $query = $conn->prepare("INSERT INTO comments
                                    (
                                        image_id,
                                        author,
                                        publication_date,
                                        message
                                    )
                                    VALUES
                                    (
                                        :image_id,
                                        :author,
                                        :publication_date,
                                        :message
                                    )");
            $query->bindParam(':image_id', $_GET['image_id']);
            $query->bindParam(':author', $author);
            $query->bindParam(':publication_date', $date);
            $query->bindParam(':message', $_GET['message']);
            $query->execute();

            $query = $conn->prepare("SELECT author FROM publications WHERE id=:id");
            $query->bindParam(':id', $_GET['image_id']);
            $query->execute();
            
            $author_name = $query->fetch()[0];

            $query = $conn->prepare("SELECT mail, comment_notif FROM __camagru_users.account_infos WHERE login=:login");
            $query->bindParam(':login', $author_name);
            $query->execute();

            if ( intval( $result['comment_notif'] ) == 1 )
                send_comment_notif( $result['mail'] );
            $conn = NULL;
            echo "OK";
        }
        else
            echo "ERROR: Failed to connect to the database, please try again later";
    }
    else
        echo "ERROR: You must be logged in to like or comment";
}
else
    echo "ERROR: Incomplete Data";
?>
