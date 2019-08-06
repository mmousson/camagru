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

// $stamp = imagecreatefrompng('../uploads/lazor.png');
// $stamp2 = scale_image('../images/filters/trollface.png', 512, 512, imagecreatefrompng, TRUE, FALSE);
$canvas_path = $_GET['canvas_path'];
$im = scale_image($canvas_path, 1920, 1800, imagecreatefromjpeg, FALSE, FALSE);
// echo $_GET['canvas_path'];
foreach ($_GET['filters_path'] as $key => $value)
{
//     // echo "Got: " . $value .  " with posx: " . $_GET['filters_posx'][$key] . " with size: " . $_GET['filters_size'][$key] . PHP_EOL;
    $stamp =  scale_image($value, $_GET['filters_size'][$key], $_GET['filters_size'][$key], imagecreatefrompng, TRUE, FALSE);
    imagecopy($im, $stamp, $_GET['filters_posx'][$key], $_GET['filters_posy'][$key], 0, 0, $_GET['filters_size'][$key], $_GET['filters_size'][$key]);
}
// echo "canvas: " . $canvas_path . PHP_EOL;
// $im = imagecreatefromjpeg('../uploads/Flag.jpg');


// Set the margins for the stamp and get the height/width of the stamp image
// $marge_right = 10;
// $marge_bottom = 10;
// $sx = imagesx($stamp);
// $sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
// imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
// imagecopy($im, $stamp, 100, 100, 0, 0, 512, 512);

// Output and free memory
header('Content-type: image/png');
// imagepng($im);
if ( imagepng($im, "../uploads/output.png", 9) === TRUE )
    echo "ALL GOOD";
else
    echo "FAILURE";
imagedestroy($im);
?>