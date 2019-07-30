<div class="top_wrapper">
<?php
	include ( "profile_left_pannel.php" );
?>
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

        <button class="update_btn">UPDATE INFORMATIONS</button>
    </div>
    <?php
		include ( "profile_right_pannel.php" );
	?>
</div>