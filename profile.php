<?php
include( "header.php" );
function    get_button_style($id)
{
    if (isset($_GET['profile']))
    {
        if (strcmp($id, $_GET['profile']) === 0)
            echo "<button style='background-color: #2464ce;'>";
        else
            echo "<button style='background-color: ghostwhite;'>";
    }
    else if (strcmp($id, "profile") === 0)
        echo "<button style='background-color: #2464ce;'>";
    else
        echo "<button style='background-color: ghostwhite;'>";
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
    <div class="top_wrapper">
        <div class="left_panel">
            <h1>PROFILE</h1>
            <h3>Avatar Picture</h3>
            
            <input type="image" onclick="slide_divs(+1)" src="/images/UI/avatar_icon.png"/>
            <p id="upload_picture_caption">Upload Picture</p>

            <div class="profile_link">
                <img src="/images/UI/fb.png">
                <p><?php echo "Add Facebook" ?></p>
            </div>

            <div class="profile_link">
                <img src="/images/UI/twitter_icon.png">
                <p><?php echo "Add Twitter" ?></p>
            </div>

            <div class="profile_link">
                <img src="/images/UI/instagram.png">
                <p><?php echo "Add Instagram" ?></p>
            </div>

            <div class="profile_link">
                <img src="/images/UI/google_plus.png">
                <p><?php echo "Add Google +" ?></p>
            </div>
        </div>
        <div class="center_panel">
            <label for="username">Username:</label>
            <input id="username" name="username" type="text"/>

            <label for="email">E-mail:</label>
            <input id="email" name="email" type="text"/>

            <label for="oldpassword">Old Password:</label>
            <input id="oldpassword" name="oldpassword" type="password"/>

            <label for="password">New Password:</label>
            <input id="password" name="password" type="password"/>

            <label for="repassword">New Password Confirmation:</label>
            <input id="repassword" name="repassword" type="password"/>
        </div>
        <div class="right_panel">
            <?php get_button_style("profile"); ?>
                <?php get_p_style("profile"); ?>Profile</p>
                <?php get_img_style("profile", "/images/UI/profile_icon.png"); ?>
            </button>
            <?php get_button_style("settings"); ?>
                <?php get_p_style("settings"); ?>Settings</p>
                <?php get_img_style("settings", "/images/UI/settings_icon.png"); ?>
            </button>
            <?php get_button_style("signout"); ?>
                <?php get_p_style("signout"); ?>Sign Out</p>
                <?php get_img_style("signout", "/images/UI/signout_icon.png"); ?>
            </button>
        </div>
    </div>
    <div class="bottom_wrapper">
    </div>
</body>
</html>