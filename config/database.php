<?php
$servername = "localhost";
$username = "root";
$password = "bleu";

try
{
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS __camagru_users";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS __camagru_users.account_infos
    (
        id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        login VARCHAR(32),
        full_name VARCHAR(64),
        phone VARCHAR(12),
        verified BOOLEAN,
        token VARCHAR(256),
        signup_date DATE
    );";
    $conn->exec($sql);

    $sql = "CREATE DATABASE IF NOT EXISTS __camagru_posts";
    $conn->exec($sql);

    echo "Database created successfully<br>";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>