<?php
session_start();

$img = $_POST['data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
$fileName = '../uploads/' . $_SESSION['user_name'] . '.png';
file_put_contents( $fileName, $fileData );

$im = imagecreatefrompng( $fileName );
imageflip( $im , IMG_FLIP_HORIZONTAL );
imagepng( $im, $fileName );

echo '../uploads/' . $_SESSION['user_name'] . '.png';
?>