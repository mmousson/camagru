<?php
?>
<html>
	<meta charset="UTF-8"/>
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="css/header.css"/>
		<link rel="shortcut icon" href="/images/ico.ico" type="image/x-icon"/>
	</head>
	<body>
		<div id="main_header">
			<input type="image" src="images/site_logo.png" onclick="window.location.href='index.php'"/>
			<div class="navigation_pannel">
				<button>GALLERY</button>
				<button onclick="window.location.href='factory.php'">THE FACTORY</button>
				<button onclick="window.location.href='about_us.php'">ABOUT US</button>
				<button onclick="window.location.href='contacts.php'">CONTACT US</button>
			</div>
			<div class="identification_pannel">
				<button onclick="window.location.href='index.php'">LOG IN</button>
				<button onclick="window.location.href='index.php'" id="register_btn">REGISTER</button>
			</div>
		</div>
	</body>
</html>
