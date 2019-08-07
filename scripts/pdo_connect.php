<?php
function    pdo_connect( $database )
{
    $servername = "localhost";
    $username = "root";
    $password = "bleu";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ( $conn );
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        return ( NULL );
    }
}
?>