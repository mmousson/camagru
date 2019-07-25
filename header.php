<?php
session_start();
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
				<?php
				if (isset($_SESSION['user_name']))
					include("fragmented_files/header_logged_in.php");
				else
					include("fragmented_files/header_not_logged_in.php");
				?>
			</div>
		</div>
	</body>
</html>
