<?php
session_start();
include_once ( "pdo_connect.php" );

if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) )
{
    $conn = pdo_connect( "__camagru_posts" );
    if ( $conn !== NULL )
    {
        $query = $conn->prepare("SELECT comment_id, author, message FROM comments WHERE image_id='" . $_GET['id'] . "'");
        $query->execute();

        $results = $query->fetchAll();
        if ( empty( $results ) )
            echo '<div id="no_comment_txt">BE THE FIRST TO COMMENT</div>';
        foreach ( $results as $match )
        {
            echo '<div class="comment">';
                echo '<div class="comment_avatar">';
                    echo '<img src="/images/UI/avatar_icon.png"/>';
                echo '</div>';
                echo '<div class="comment_infos">';
                    if ( strcmp( $match['author'], "root" ) === 0 )
                        echo '<p style="color: red;" class="comment_author">' . $match['author'] . '</p>';
                    else
						echo '<p class="comment_author">' . $match['author'] . '</p>';
					echo '<p class="comment_content">' . $match['message'] . '</p>';
					if ( strcmp( $_SESSION['user_name'], "root" ) === 0
						|| strcmp( $_SESSION['user_name'], $match['author'] ) === 0 )
						echo '<input type="image" id="' . $match['comment_id'] . '" class="delete_comment_btn" src="/images/UI/checkmark_ko.png" title="Delete That Comment"/>';
                echo '</div>';
            echo '</div>';
        }
        $conn = NULL;
    }
}
else
    echo "ERROR: Incomplete Data";
?>