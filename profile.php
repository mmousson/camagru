<?php
include( "header.php" );
require_once( "scripts/user_management.php" );
function    get_button_style($id)
{
    if (isset($_GET['profile']))
    {
        if (strcmp($id, $_GET['profile']) === 0)
            echo "<button id='btn_$id' class='focus_btn'>";
        else
            echo "<button id='btn_$id' class='clear_btn'>";
    }
    else if (strcmp($id, "profile") === 0)
        echo "<button id='btn_$id' class='focus_btn'>";
    else
        echo "<button id='btn_$id' class='clear_btn'>";
}

function    get_p_style($id)
{
    if (isset($_GET['profile']))
    {
        if (strcmp($id, $_GET['profile']) === 0)
            echo "<p style='color: white;'>";
        else
            echo "<p style='color: black;'>";
    }
    else if (strcmp($id, "profile") === 0)
        echo "<p style='color: white;'>";
    else
        echo "<p style='color: black;'>";
}

function    get_img_style($id, $src)
{
    if (isset($_GET['profile']))
    {
        if (strcmp($id, $_GET['profile']) === 0)
            echo '<img style="filter: invert(0);" src="' . $src . '"/>';
        else
            echo '<img style="filter: invert(1);" src="' . $src . '"/>';
    }
    else if (strcmp($id, "profile") === 0)
        echo '<img style="filter: invert(0);" src="' . $src . '"/>';
    else
        echo '<img style="filter: invert(1);" src="' . $src . '"/>';
}
?>
<html>
<head>
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="css/profile.css"/>
</head>
<body>
    <div class="cover_image">
    </div>
    <?php
		if ($_SESSION['logged_in'] === true)
		{
			if (isset($_GET['profile']))
			{
				if (strcmp($_GET['profile'], "settings") === 0)
					include ( "fragmented_files/profile_settings.php" );
				else
					include ( "fragmented_files/profile_logged_in.php" );
			}
			else
				include ( "fragmented_files/profile_logged_in.php" );
		}
        else
            include ( "fragmented_files/profile_not_logged_in.php" );
    ?>
</body>
<script type="text/javascript" src="js/profile.js"></script>
</html>