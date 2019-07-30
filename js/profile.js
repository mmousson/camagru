profile_btn = document.getElementById("btn_profile");
settings_btn = document.getElementById("btn_settings");
signout_btn = document.getElementById("btn_signout");
update_settings_btn = document.getElementById("btn_update_settings");

if (profile_btn != null)
{
	profile_btn.addEventListener("click",
		function () { window.location.href = "/profile.php?profile=profile"; });
	settings_btn.addEventListener("click",
		function () { window.location.href = "/profile.php?profile=settings"; });
	signout_btn.addEventListener("click",
		function () { window.location.href = "/index.php?login=logout"; });
}

if (update_settings_btn != null)
{
	update_settings_btn.addEventListener("click", function () {
		var	xhttp;
		var	like_value;
		var	comment_value;
	
		update_settings_btn.innerHTML = "Updating...";
		like_value = document.getElementById("notif_like_check").checked;
		comment_value = document.getElementById("notif_comment_check").checked;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if ( this.readyState == 4 && this.status == 200 )
			{
				if (this.responseText == "OK")
					update_settings_btn.innerHTML = "Settings Updated !";
				else
					update_settings_btn.innerHTML = "An error occured";
				setTimeout(function () {
					update_settings_btn.innerHTML = "UPDATE SETTINGS";
				}, 2000);
			}
		}
		xhttp.open("GET", "/scripts/update_settings.php?like=" + like_value + "&comment=" + comment_value, true);
		xhttp.send();
	});
}