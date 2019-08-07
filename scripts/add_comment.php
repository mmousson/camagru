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
