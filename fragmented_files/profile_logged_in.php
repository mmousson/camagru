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
        <input id="username" name="username" type="text" value=<?php echo '"' . $_SESSION['user_name'] . '"'; ?>/>

        <label for="email">E-mail:</label>
        <input id="email" name="email" type="text" value=<?php echo '"' . get_user_mail($_SESSION['user_name']) . '"'; ?>/>

        <label for="oldpassword">Old Password:</label>
        <input id="oldpassword" name="oldpassword" type="password" placeholder="Please Enter Your Old Passsword"/>

        <label for="password">New Password:</label>
        <input id="password" name="password" type="password" placeholder="Please Enter A New Password"/>

        <label for="repassword">New Password Confirmation:</label>
        <input id="repassword" name="repassword" type="password" placeholder="Please Confirm Your New Password"/>

        <button>UPDATE INFORMATIONS</button>
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