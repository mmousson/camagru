var slide_index = 1;
var	validate_form_btns = document.querySelectorAll(".input_text");
var	register_btn = document.getElementById("submit");
var	login_btn = document.getElementById("login");
var	reset_btn = document.getElementById("reset");
var	new_pass_btn = document.getElementById("new_pass_btn");

function add_enter_listener(event) {
	if (event.keyCode === 13)
	{
		submit_register_form();
		submit_login_form();
		submit_reset_form();
		submit_new_password();
	}
}

validate_form_btns.forEach(function (elem) {
	elem.addEventListener("keyup", add_enter_listener);
});

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

function submit_register_form()
{
	var	xhttp;

	if (document.getElementById("mobile") == null)
		return ;
	register_btn.innerHTML = "Registering...";
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText != "")
			{
				document.getElementById("error_msg").style.display = "inline";
				document.getElementById("error_msg").style.top = "0%";
				document.getElementById("message").innerHTML = this.responseText;
				register_btn.innerHTML = "NEXT";
			}
			else
			{
				document.getElementById("error_msg").style.display = "inline";
				document.getElementById("error_msg").style.backgroundColor = "rgba(70, 255, 86, 0.905)";
				document.getElementById("message").innerHTML = "Registration Complete ! A confirmation e-mail has been sent to you";
				register_btn.innerHTML = "DONE";
			}
		}
	}
	xhttp.open("POST", "/scripts/register.php");
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("mobile=" + document.getElementById("mobile").value
		+ "&mail=" + document.getElementById("mail").value
		+ "&full_name=" + document.getElementById("full_name").value
		+ "&user_name=" + document.getElementById("user_name").value
		+ "&pass=" + document.getElementById("pass").value
		+ "&repass=" + document.getElementById("repass").value);
}

function submit_login_form()
{
	var	xhttp;

	if (login_btn == null)
		return ;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "OK")
				window.location.replace("/factory.php");
			else
			{
				document.getElementById("error_msg").style.display = "inline";
				document.getElementById("error_msg").style.top = "0%";
				document.getElementById("message").innerHTML = this.responseText;
			}
		}
	}
	xhttp.open("POST", "/scripts/login.php");
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("user_name=" + document.getElementById("user_name").value
		+ "&pass=" + document.getElementById("pass").value);
}

function submit_reset_form()
{
	var	xhttp;

	if (reset_btn == null)
		return ;
	reset_btn.innerHTML = "Processing...";
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "OK")
			{
				document.getElementById("error_msg").style.display = "inline";
				document.getElementById("error_msg").style.backgroundColor = "rgba(70, 255, 86, 0.905)";
				document.getElementById("message").innerHTML = "Password reset request sent! Check your mail inbox";
				reset_btn.innerHTML = "DONE";
			}
			else
			{
				document.getElementById("error_msg").style.display = "inline";
				document.getElementById("error_msg").style.top = "0%";
				document.getElementById("message").innerHTML = this.responseText;
				reset_btn.innerHTML = "REQUEST A RESET LINK";
			}
		}
	}
	xhttp.open("GET", "/scripts/reset_password.php?login=" + document.getElementById("user_name").value
		+ "&mail=" + document.getElementById("mail").value);
	xhttp.send();
}

function submit_new_password()
{
	var	xhttp;

	if (new_pass_btn == null)
		return ;
	new_pass_btn.innerHTML = "Processing...";
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "OK")
				document.location.href = "/index.php?login=true";
			else
			{
				document.getElementById("error_msg").style.display = "inline";
				document.getElementById("error_msg").style.top = "0%";
				document.getElementById("message").innerHTML = this.responseText;
				new_pass_btn.innerHTML = "RESET PASSWORD";
			}
		}
	}
	xhttp.open("GET", "/scripts/reset_password.php?new_pass=" + document.getElementById("new_pass").value
		+ "&re_new_pass=" + document.getElementById("re_new_pass").value);
	xhttp.send();
}

if (register_btn != null)
{
	register_btn.addEventListener("click", function () {
		submit_register_form();
	});
}
else if (login_btn != null)
{
	login_btn.addEventListener("click", function () {
		submit_login_form();
	});
}
else if (reset_btn != null)
{
	reset_btn.addEventListener("click", function () {
		submit_reset_form();
	});
}
else if (new_pass_btn != null)
{
	new_pass_btn.addEventListener("click", function () {
		submit_new_password();
	});
}