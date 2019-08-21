<?php
include_once ( "scripts/pdo_connect.php" );

function    sort_by_date_recent($a, $b)
{
    $offset = strcmp( $a['publication_date'], $b['publication_date'] );
    if ( $offset == 0 )
        return ( 0 );
    else
        return ( $offset < 0 ? 1 : -1 );
}

function    sort_by_date_ancient($a, $b)
{
    $offset = strcmp( $a['publication_date'], $b['publication_date'] );
    if ( $offset == 0 )
        return ( 0 );
    else
        return ( $offset < 0 ? -1 : 1 );
}

function    sort_by_likes($a, $b)
{
    $offset = intval( $a['likes'] ) - intval( $b['likes'] );
    if ( $offset == 0 )
        return ( 0 );
    else
        return ( $offset < 0 ? 1 : -1 );
}

$filter = "public='1'";
if ( isset( $_GET['filter'] ) )
{
    if ( strcmp( $_GET['filter'], "private" ) === 0 )
        $filter = "author='" . $_SESSION['user_name'] . "' AND public='0'";
    else if ( strcmp( $_GET['filter'], "public" ) === 0 )
        $filter = "author='" . $_SESSION['user_name'] . "' AND public='1'";
}

$conn = pdo_connect( "__camagru_posts" );
if ( $conn !== NULL )
{
    $query = $conn->prepare("SELECT id, author, publication_date, likes FROM __camagru_posts.publications WHERE $filter");
    $query->execute();

    $results = $query->fetchAll();

    if ( isset( $_GET['filter'] ) )
    {
        if ( strcmp( $_GET['filter'], "recent" ) === 0 )
            usort( $results, sort_by_date_recent );
        else if ( strcmp( $_GET['filter'], "ancient" ) === 0 )
            usort( $results, sort_by_date_ancient );
        else if ( strcmp( $_GET['filter'], "liked" ) === 0 )
            usort( $results, sort_by_likes );
    }

    foreach ( $results as $post )
    {
        echo '<div class="photo_wrapper mosaic_6" onclick="picture_show_overlay(' . $post['id'] . ')" style="background-image: url(/posts/' . $post['id'] . '.png);">';
        echo "</div>";
    }
    $conn = NULL;
}
else
    echo "FATAL ERROR";
?>
