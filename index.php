<?php
session_start();
include_once ( "error_msg.php" );
include_once ( "scripts/user_management.php" );
include_once ( "scripts/pdo_connect.php" );
?>
<html>
	<meta charset="UTF-8">
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
	</head>
	<body>
		<section class="wrapper">
		<div class="log_panel">
			<img class="camagru_logo" src="images/camagru_logo.png" alt="Camagru Logo"/>
<?php
if (isset($_GET['login']))
{
	if ( strcmp( $_GET['login'], "true" ) === 0 )
		include( "scripts/generate_login.php" );
	else if ( strcmp( $_GET['login'], "logout" ) === 0 )
	{
		$_SESSION['logged_in'] = FALSE;
		$_SESSION['user_name'] = NULL;
		include( "scripts/generate_login.php" );
	}
	else if ( strcmp( $_GET['login'], "delete_account" ) === 0 )
	{
		if ( $_SESSION['logged_in'] === TRUE )
		{
			if ( strcmp( hash( "md5", $_SESSION['user_name'] ), $_GET['delete_check'] ) === 0 )
			{
				remove_user( $_SESSION['user_name'] );
				$_SESSION['logged_in'] = FALSE;
				$_SESSION['user_name'] = NULL;
				include ( "scripts/generate_login.php" );
			}
			else
				include ( "scripts/generate_register.php" );
		}
		else
			include ( "scripts/generate_register.php" );
	}
	else if ( strcmp( $_GET['login'], "verify" ) === 0 )
	{
		$conn = pdo_connect( "__camagru_users" );
		if ( $conn !== NULL )
		{
			$query = $conn->prepare("UPDATE account_infos SET verified='1' WHERE token=:token");
			$query->bindParam(':token', $_GET['token']);
			$query->execute();

			include_once ( "scripts/generate_login.php" );
			$conn = NULL;
		}
	}
	else
		include( "scripts/generate_register.php" );
}
else
	include( "scripts/generate_register.php" );
?>			
			<hr/>
			<p>
				En vous inscrivant, vous acceptez nos <a href="/conditions.php">Conditions générales</a>. Découvrez comment nous recueillons, utilisons et partageons vos données en lisant notre <a href="/privacy.php">Politique d’utilisation des donnees</a>.
			</p>
			<p>© 2019 mmousson</p>
		</div>

		<div class="slider">
			<section class="slides_wrapper">
				<img class="slides" src="images/posts/0-0/post_img.jpg"/>
				<input type="image" class="previous_btn" onclick="slide_divs(-1)" src="images/UI/prev_btn.png"/>
				<input type="image" class="next_btn" onclick="slide_divs(+1)" src="images/UI/next_btn.png"/>
			</section>

			<section class="slides_wrapper">
				<img class="slides" src="images/posts/1-0/post_img.jpg"/>
				<input type="image" class="previous_btn" onclick="slide_divs(-1)" src="images/UI/prev_btn.png"/>
				<input type="image" class="next_btn" onclick="slide_divs(+1)" src="images/UI/next_btn.png"/>
			</section>
			
			<section class="slides_wrapper">
				<img class="slides" src="images/posts/2-0/post_img.jpg"/>
				<input type="image" class="previous_btn" onclick="slide_divs(-1)" src="images/UI/prev_btn.png"/>
				<input type="image" class="next_btn" onclick="slide_divs(+1)" src="images/UI/next_btn.png"/>
			</section>
		</div>
		</section>
		<div class="useful_pannel">
		<a class="useful_link" href="about_us.php">ABOUT US</a>
		<a class="useful_link" href="support.php">SUPPORT</a>
		<a class="useful_link" href="privacy.php">COOKIES</a>
		<a class="useful_link" href="contacts.php">CONTACTS</a>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</html>
