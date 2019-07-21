<?php
function    get_database($name)
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = $name;

    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    if ( $conn !== null )
    {    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        return ( $conn );
    }
    else
        echo "Connection failed!\n";
    return ( $conn );
}

function	user_exists($user)
{
    $db = get_database("users");
    $db = null;
}
$db = get_database("users");
$db = null;
?>
