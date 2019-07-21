<?php
$servername = "localhost";
$username = "root";
$password = "root";

$link = mysql_connect($servername, $username, $password) or die("Impossible de se connecter : " . mysql_error());
echo 'Connexion reussie';
mysql_close($link);
$conn = null;
?>