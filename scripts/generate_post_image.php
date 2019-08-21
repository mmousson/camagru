<?php
session_start();
function	endsWith( $string, $endString )
{ 
	$len = strlen( $endString );
	if ( $len == 0 ) {
		return true;
	}
	return ( substr( $string, -$len ) === $endString );
}

function	scale_image($file, $w, $h, $create_func, $preserve_alpha=FALSE, $crop=FALSE) {
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

if ( count( $_GET['filters_path'] ) == 0 )
{
    echo "ERROR: You must add at least one filter";
    exit();
}

$create_func = NULL;
$canvas_path = $_GET['canvas_path'];

if ( endsWith( $canvas_path, ".png" ) === TRUE )
    $create_func = imagecreatefrompng;
else if ( endsWith( $canvas_path, ".jpeg" ) === TRUE )
    $create_func = imagecreatefromjpeg;
else if ( endsWith( $canvas_path, ".jpg" ) === TRUE )
    $create_func = imagecreatefromjpeg;

$im = scale_image($canvas_path, (int)($_GET['canvas_size'] / 9 * 16), (int)$_GET['canvas_size'], $create_func, FALSE, FALSE);

foreach ($_GET['filters_path'] as $key => $value)
{
    $stamp =  scale_image($value, $_GET['filters_size'][$key], $_GET['filters_size'][$key], imagecreatefrompng, TRUE, FALSE);
    if ( strcmp( $_GET['flipped'][$key], "true" ) === 0 )
        imageflip( $stamp, IMG_FLIP_HORIZONTAL );
    $offset_x = (((int)$_GET['canvas_size'] / 9 * 16) - imagesx($im)) / 2;
    $offset_y = ((int)$_GET['canvas_size'] - imagesy($im)) / 2;
    imagecopy($im, $stamp, $_GET['filters_posx'][$key] - $offset_x, $_GET['filters_posy'][$key] - $offset_y, 0, 0, $_GET['filters_size'][$key], $_GET['filters_size'][$key]);
}

//Apply filter effects
if ( strcmp( $_GET['grayscale'], "1" ) === 0 )
    imagefilter( $im, IMG_FILTER_GRAYSCALE );
imagefilter( $im, IMG_FILTER_BRIGHTNESS, ((intval( $_GET['brightness'] ) - 100) * 2.55) );
if ( strcmp( $_GET['invert'], "1" ) === 0 )
    imagefilter( $im, IMG_FILTER_NEGATE );
if ( strcmp( $_GET['sepia'], "1" ) === 0 )
{
    imagefilter( $im, IMG_FILTER_GRAYSCALE);
    imagefilter( $im, IMG_FILTER_COLORIZE, 100, 50, 0);
}

$path = "../uploads/output_" . $_SESSION['user_name'] . ".png";
if ( imagepng($im, $path, 9) === TRUE )
    echo $path;
else
    echo "ERROR: An error occured, please try again later";
imagedestroy($im);
?>