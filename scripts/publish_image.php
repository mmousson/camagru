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

    if ( $_SESSION['logged_in'] === TRUE )
    {
        if ( $conn !== NULL )
        {
            $login = $_SESSION['user_name'];
            $date = date("Y-m-d H:i:s");
            $message = $_GET['message'];
            $query = $conn->prepare("INSERT INTO __camagru_posts.publications
                                    (
                                        author,
                                        publication_date,
                                        message
                                    )
                                    VALUES
                                    (
                                        :author,
                                        :publication_date,
                                        :message
                                    )");
            $query->bindParam(':author', $login);
            $query->bindParam(':publication_date', $date);
            $query->bindParam(':message', $message);
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
    }
    else
        echo "You must be logged in to publish creations";
    $conn = NULL;
}
else
    echo "ERROR: Incomplete data";
?>