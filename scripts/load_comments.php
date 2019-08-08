<?php
include_once ( "pdo_connect.php" );

if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) )
{
    $conn = pdo_connect( "__camagru_posts" );
    if ( $conn !== NULL )
    {
        $query = $conn->prepare("SELECT author, message FROM comments WHERE image_id='" . $_GET['id'] . "'");
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
                echo '</div>';
            echo '</div>';
        }
        $conn = NULL;
    }
}
else
    echo "ERROR: Incomplete Data";
?>