<?php
include_once("header.php");
?>
<html>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/contacts.css"/>
	<body>
		<div id="hero_image">
			<div id="hero_text"/>
				<h1>CONTACT US</h1>
				<p id="white_p">Have a question ? Need a tip ? You can find a host of brilliant articles in our knowledge base ! If you can't find what you are looking for, feel free to send us an email or even give us a call at (+33)2.67.00.00.00</p>
			</div>
		</div>
		<div id="form_wrapper">
			<form>
				<label for="fname">First Name</label>
				<input id="fname" name="fname" type="text" placeholder="Please enter your first name..." required/>
				<label for="lname">First Name</label>
				<input id="lname" name="lname" type="text" placeholder="Please enter your last name..." required/>
				<label for="mail">e-mail</label>
				<input id="mail" name="mail" type="text" placeholder="Please enter your e-mail..." required/>
				<label for="subject"></label>
				<textarea id="subject" name="subject" type="text" placeholder="Enter your message here..." required></textarea>
				<input type="submit" value="submit"/>
			</form>
		</div>
	</body>
</html>
