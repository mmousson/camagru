<?php
function    pdo_connect( $database )
{
    try
    {
        $conn = new PDO("mysql:host=localhost;dbname=$database", "root", "bleu");
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