<?php
session_start();
echo hash("md5", $_SESSION['user_name']);
?>