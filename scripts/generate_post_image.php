<?php
if ( isset($_GET['dest_img']) && isset($_GET['filters_array']) )
{
    $dest = imagecreatefromjpg( $_GET['dest_img'] );

    foreach ( $_GET['filters_array'] as $key => $value )
    {
        echo "GOT: " . $key . " => " . $value;
    }

    // Copie et fusionne
    // imagecopymerge($dest, $src, 10, 10, 0, 0, 100, 47, 75);

    // // Affichage et libération de la mémoire
    // header('Content-Type: image/gif');
    // imagegif($dest, "../posts/output.gif");

    // imagedestroy($dest);
    // imagedestroy($src);
    echo "OK";
}
else
    echo "ERROR: Incomplete data";
?>