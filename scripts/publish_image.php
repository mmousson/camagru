<?php
function    pdo_connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "bleu";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=__camagru_users", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ( $conn );
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        return ( NULL );
    }
}

if ( isset( $_GET['path'] ) && !empty( $_GET['path'] ) )
{
    $conn = pdo_connect();
    session_start();
    if ( $conn !== NULL )
    {
        $login = $_SESSION['user_name'];
        $date = date("Y-m-d H:i:s");
        $query = $conn->prepare("INSERT INTO __camagru_posts.publications
                                (
                                    author,
                                    publication_date
                                )
                                VALUES
                                (
                                    :author,
                                    :publication_date
                                )");
        $query->bindParam(':author', $login);
        $query->bindParam(':publication_date', $date);
        $query->execute();

        $other = $conn->prepare('SELECT id FROM __camagru_posts.publications
                                WHERE
                                (
                                    author="' . $login. '" AND publication_date="' . $date . '")');
        $other->execute();
        $id = $other->fetch()['id'];

        copy( $_GET['path'], "../posts/" . $id . ".png");
        unlink( $_GET['pathl'] );
        echo "OK";
    }
    $conn = NULL;
}
else
    echo "ERROR: Incomplete data";
?>