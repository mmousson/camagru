profile_btn = document.getElementById("btn_profile");
settings_btn = document.getElementById("btn_settings");
signout_btn = document.getElementById("btn_signout");

profile_btn.addEventListener("click", function () { window.location.href = "/profile.php?profile=profile"; });
settings_btn.addEventListener("click", function () { window.location.href = "/profile.php?profile=settings"; });
signout_btn.addEventListener("click", function () { window.location.href = "/index.php?login=logout"; });