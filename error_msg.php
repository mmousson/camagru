<html>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/error_msg.css"/>
	<body>
		<div id="error_msg">
			<p id="message"></p>
			<input type="image" src="images/UI/cross_close_icon.png" onclick="close_error_msg()"/>
		</div>
	</body>
	<script>
		var	msg;

		msg = find_get_parameter("ERROR");
		if (msg != null)
		{
			console.log("Error successfully retrieved");
			document.getElementById("message").innerHTML = msg;
		}
		else
			console.log("No error message found");

		function close_error_msg() { document.getElementById("error_msg").style.top = "-5%"; setTimeout(disable_error_msg, 1010); }
		function disable_error_msg() { document.getElementById("error_msg").remove(); }

		function find_get_parameter(parameter_name)
		{
			var	result = null;
			var	tmp = [];

			location.search
				.substr(1)
				.split("&")
				.forEach(function (item)
				{
					tmp = item.split("=");
					if (tmp[0] === parameter_name)
						result = decodeURIComponent(tmp[1]);
				});
			return result;
		}
	</script>
</html>
