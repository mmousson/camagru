<?php
include_once ( "pdo_connect.php" );

if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) )
{
    $conn = pdo_connect( "__camagru_posts" );
    if ( $conn !== NULL )
    {
        $query = $conn->prepare("SELECT author FROM publications WHERE id=:id");
        $query->bindParam(':id', $_GET['id']);
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