<?php
?>
<html>
	<meta charset="UTF-8">
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
	</head>

	<body>
		<div class="log_panel">
			<img class="camagru_logo" src="images/camagru_logo.png" alt="Camagru Logo"/>
			<form class="log_inputs">
				<input class="input_text" type="tel" id="mobile" name="mobile" placeholder="Phone Number" required>
				<input class="input_text" type="email" id="mail" name="mail" placeholder="e-mail" required>
				<input class="input_text" type="text" id="full_name" name="full_name" placeholder="Full Name" required>
				<input class="input_text" type="text" id="user_name" name="user_name" placeholder="User Name" minlength="6" maxlength="15" required>
				<input class="input_text" type="password" id="pass" name="pass" minlength="6" maxlength="18" placeholder="Enter a password" required>
				<input class="input_text" type="password" id="repass" name="repass" minlength="6" maxlength="18" placeholder="Confirm your password" required>
				<input class="submit" type="submit" id="submit" name="submit" value="NEXT" />
			</form>
			<hr/>
			<p>
				En vous inscrivant, vous acceptez nos <a href="src/useful_links/conditions.php">Conditions générales</a>. Découvrez comment nous recueillons, utilisons et partageons vos données en lisant notre <a href="src/useful_links/data.php">Politique d’utilisation des données</a> et comment nous utilisons les cookies et autres technologies similaires en consultant notre <a href="src/useful_links/cookies.php">Politique d’utilisation des cookies</a>.
			</p>
		</div>
	</body>

	<footer>
		<div class="useful_links">
			<a href="about_us.php">ABOUT US</a>
			<a href="support.php">SUPPORT</a>
			<a href="privacy.php">PRIVACY</a>
			<a href="contacts.php">CONTACTS</a>
		</div>
		<br/>
		<p>© 2019 mmousson</p>
	</footer>
</html>

