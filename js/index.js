var slide_index = 1;
carousel();

function slide_divs(amount)
{
	show_divs(slide_index += amount);
}

function show_divs(index)
{
	var	i;
	var	x;

	x = document.getElementsByClassName("slides_wrapper");
	if (index > x.length)
		slide_index = 1;
	if (index < 1)
		slide_index = x.length;
	for (i = 0; i < x.length; i++)
		x[i].style.display = "none";
	console.log(slide_index - 1);
	x[slide_index - 1].style.display = "block";
}

function carousel()
{
	var	i;
	var	x;

	x = document.getElementsByClassName("slides_wrapper");
	console.log(x);
	for (i = 0; i < x.length; i++)
		x[i].style.display = "none";
	slide_index++;
	if (slide_index > x.length) {slide_index = 1;} 
	x[slide_index - 1].style.display = "block"; 
	setTimeout(carousel, 5000);
}

$("#submit").click(function () {
	$.post(
		'/scripts/register.php',

		{
			mobile: $("#mobile").val(),
			mail: $("#mail").val(),
			full_name: $("#full_name").val(),
			user_name: $("#user_name").val(),
			pass: $("#pass").val(),
			repass: $("#repass").val()
		},

		function (data) {
			if (data != "")
			{
				$("#error_msg").css("display", "inline");
				$("#error_msg").css("top", "0%");
				$("#message").text(data);
			}
			else
			{
				$("#error_msg").css("display", "inline");
				$("#error_msg").css("background-color", "rgba(70, 255, 86, 0.905)");
				$("#message").text("Registration Complete ! A confirmation e-mail has been sent to you");
			}
		},

		'text');
});

$("#login").click(function () {
	$.post(
		'/scripts/login.php',

		{
			user_name: $("#user_name").val(),
			pass: $("#pass").val()
		},

		function (data) {
			if (data == "OK")
				window.location.replace("/factory.php");
			else
			{
				$("#error_msg").css("display", "inline");
				$("#error_msg").css("top", "0%");
				$("#message").text(data);
			}
		},

		'text');
});
