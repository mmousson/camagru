<?php
function scale_image($file, $w, $h, $create_func, $preserve_alpha=FALSE, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = $create_func($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);

    if( $preserve_alpha === TRUE )
    {
        imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
    }

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

$canvas_path = $_GET['canvas_path'];
echo "Received: " . $_GET['canvas_size'];
$im = scale_image($canvas_path, (int)($_GET['canvas_size'] / 9 * 16), (int)$_GET['canvas_size'], imagecreatefromjpeg, FALSE, FALSE);
foreach ($_GET['filters_path'] as $key => $value)
{
    $stamp =  scale_image($value, $_GET['filters_size'][$key], $_GET['filters_size'][$key], imagecreatefrompng, TRUE, FALSE);
    if ( strcmp( $_GET['flipped'][$key], "true" ) === 0 )
        imageflip( $stamp, IMG_FLIP_HORIZONTAL );
    $offset_x = (((int)$_GET['canvas_size'] / 9 * 16) - imagesx($im)) / 2;
    $offset_y = ((int)$_GET['canvas_size'] - imagesy($im)) / 2;
    imagecopy($im, $stamp, $_GET['filters_posx'][$key] - $offset_x, $_GET['filters_posy'][$key] - $offset_y, 0, 0, $_GET['filters_size'][$key], $_GET['filters_size'][$key]);
}

header('Content-type: image/png');
if ( imagepng($im, "../uploads/output.png", 9) === TRUE )
    echo "ALL GOOD";
else
    echo "FAILURE";
imagedestroy($im);
?>