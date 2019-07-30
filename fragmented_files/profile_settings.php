<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/toggle_switch.css"/>
	</head>
	<div class="top_wrapper">
		<?php
			include ( "profile_left_pannel.php" );
		?>
		<div class="center_panel">
			<div class="settings_wrapper">
				<label for="notif_like_check" class="switch">
					<input id="notif_like_check" type="checkbox"
						<?php
							echo get_user_preference($_SESSION['user_name'], "like_notif");
						?>/>
					<span class="slider"></span>
				</label>
				<p>Receive a Notification when a post of yours receives a like</p>
			</div>

			<div class="settings_wrapper">
				<label for="notif_comment_check" class="switch">
					<input id="notif_comment_check" type="checkbox"
						<?php
							echo get_user_preference($_SESSION['user_name'], "comment_notif");
						?>/>
					<span class="slider"></span>
				</label>
				<p>Receive a Notification when a post of yours receives a comment</p>
			</div>

			<button id="btn_update_settings" class="update_btn">UPDATE SETTINGS</button>
			<button id="delete_account_btn">DELETE ACCOUNT</button>
		</div>
		<?php
			include ( "profile_right_pannel.php" );
		?>
	</div>
</html>