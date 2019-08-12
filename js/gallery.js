var	mosaic_18 = document.getElementById("18");
var	mosaic_6 = document.getElementById("6");
var	mosaic_1 = document.getElementById("1");
var	grid = document.querySelector(".photos_grid");

function	set_grid_property(element)
{
	var	i;
	var	mosaic_elements = document.querySelectorAll(".photo_wrapper");

	if (element == mosaic_1)
	{
		grid.style.gridTemplateColumns = "auto";
		for (i = 0; i < mosaic_elements.length; i++)
		{
			mosaic_elements[i].classList.remove("mosaic_1");
			mosaic_elements[i].classList.remove("mosaic_6");
			mosaic_elements[i].classList.remove("mosaic_18");
			mosaic_elements[i].classList.add("mosaic_1");
		}
	}
	else if (element == mosaic_6)
	{
		grid.style.gridTemplateColumns = "auto auto auto";
		for (i = 0; i < mosaic_elements.length; i++)
		{
			mosaic_elements[i].classList.remove("mosaic_1");
			mosaic_elements[i].classList.remove("mosaic_6");
			mosaic_elements[i].classList.remove("mosaic_18");
			mosaic_elements[i].classList.add("mosaic_6");
		}
	}
	else
	{
		grid.style.gridTemplateColumns = "auto auto auto auto auto";
		for (i = 0; i < mosaic_elements.length; i++)
		{
			mosaic_elements[i].classList.remove("mosaic_1");
			mosaic_elements[i].classList.remove("mosaic_6");
			mosaic_elements[i].classList.remove("mosaic_18");
			mosaic_elements[i].classList.add("mosaic_18");
		}
	}
}

function	gallery_mosaic_event_handler(elem)
{
	var	that_one = document.getElementById(elem.toElement.id);
	var	src = that_one.src;

	if (src.includes("normal"))
	{
		src.replace("normal", "pressed");
		var	mosaic_btns = document.querySelectorAll(".mosaic_btn");
		mosaic_btns.forEach(function (element) {
			if (element.src.includes("normal") && element == that_one)
			{
				element.src = element.src.replace("normal", "pressed");
				set_grid_property(element);
			}
			else if (element.src.includes("pressed") && element != that_one)
				element.src = element.src.replace("pressed", "normal");
		});
	}
}

mosaic_1.addEventListener("click", gallery_mosaic_event_handler);
mosaic_6.addEventListener("click", gallery_mosaic_event_handler);
mosaic_18.addEventListener("click", gallery_mosaic_event_handler);

var	overlay_active = false;
var	active_id = -1;
var	overlay = document.querySelector(".overlay");
var	overlay_wrapper = overlay.querySelector(".wrapper");
var	overlay_image = overlay.querySelector(".overlay_image");
var	author_label= overlay.querySelector("#author_label");
var	comments_wrapper = overlay.querySelector(".comments_wrapper");
var	comment_btn = overlay.querySelector("#comment_button");
var	comment_input = overlay.querySelector("#comment_textarea");
var	delete_btn = overlay.querySelector("#delete_post");

window.addEventListener("click", function (e) {
	if (overlay_active && !overlay_wrapper.contains(e.target))
	{
		overlay_active = false;
		overlay.style.opacity = "0";
		overlay.style.display = "none";
	}
});

function	get_pic_author(id)
{
	var	xhttp;

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText.startsWith("ERROR:"))
				console.log(this.responseText);
			else
			{
				author_label.innerHTML = "Posted by: " + this.responseText;
			}
		}
	}
	xhttp.open("GET", "/scripts/get_pic_author.php?id=" + id);
	xhttp.send();
}

function	load_likes_state(id)
{
	var	xhttp;

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "1")
			{
				document.querySelector("#like_btn").src = "/images/UI/like_clicked.png";
				document.querySelector("#dislike_btn").src = "/images/UI/dislike_icon.png";
			}
			else if (this.responseText == "-1")
			{
				document.querySelector("#like_btn").src = "/images/UI/like_icon.png";
				document.querySelector("#dislike_btn").src = "/images/UI/dislike_clicked.png";
			}
			else
			{
				document.querySelector("#like_btn").src = "/images/UI/like_icon.png";
				document.querySelector("#dislike_btn").src = "/images/UI/dislike_icon.png";	
			}
		}
	}
	xhttp.open("GET", "/scripts/get_likes_state.php?id=" + id);
	xhttp.send();
}

function	picture_show_overlay(id)
{
	var	xhttp;

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			active_id = id;
			overlay_active = true;
			overlay.style.display = "block";
			overlay.style.opacity = "1";
			overlay_image.style.backgroundImage = "url(/posts/" + id + ".png)";

			get_pic_author(id);
			load_likes_state(id);

			comments_wrapper.innerHTML = this.responseText;

			//Once all comments are loaded, add event listener to allow the user
			//(or the root) to delete the comments he is allowed to
			var	xhttp_delete;
			var	delete_buttons = comments_wrapper.querySelectorAll(".delete_comment_btn");
			delete_buttons.forEach(function (element) {
				element.addEventListener("click", delete_comment);
			});
			xhttp_delete = new XMLHttpRequest();
			xhttp_delete.onreadystatechange = function () {
				if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
				{
					if (this.responseText == "OK")
						delete_btn.style.display = "inline-block";
					else if (this.responseText == "DENIED")
						delete_btn.style.display = "none";
				}
			}
			xhttp_delete.open("GET", "/scripts/administrative_functions.php?delete_type=check"
				+ "&image_id=" + overlay_image.style.backgroundImage.substring(12).replace(".png\")", ""));
			xhttp_delete.send();
		}
	}
	xhttp.open("GET", "/scripts/load_comments.php?id=" + id, true);
	xhttp.send();
}

var	is_sending_comment = false;
comment_btn.addEventListener("click", function () {
	var	xhttp;

	if (is_sending_comment)
		return ;
	is_sending_comment = true;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "OK")
			{
				comment_input.value = "";
				picture_show_overlay(active_id);
			}
			else
				alert(this.responseText.slice(7));
			is_sending_comment = false;
		}
	}
	xhttp.open("GET", "/scripts/add_comment.php?"
		+ "image_id=" + active_id
		+ "&message=" + comment_input.value);
	xhttp.send();
});

var	is_deleting = false;
delete_btn.addEventListener("click", function () {
	var	xhttp;

	if (is_deleting)
		return ;
	is_deleting = true;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "OK")
				document.location.reload(true);
			else
			{ //Error handling
			}
			is_deleting = false;
		}
	}
	xhttp.open("GET", "/scripts/administrative_functions.php?delete_type=post"
		+ "&image_id=" + overlay_image.style.backgroundImage.substring(12).replace(".png\")", "") );
	xhttp.send();
});

function	upvote(amount)
{
	var	xhttp;

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText == "OK")
			{
				if (amount == 1)
				{
					document.querySelector("#like_btn").src = "/images/UI/like_clicked.png";
					document.querySelector("#dislike_btn").src = "/images/UI/dislike_icon.png";
				}
				else
				{
					document.querySelector("#like_btn").src = "/images/UI/like_icon.png";
					document.querySelector("#dislike_btn").src = "/images/UI/dislike_clicked.png";
				}
			}
		}
	}
	xhttp.open("GET", "/scripts/upvote.php?"
		+ "image_id=" + active_id
		+ "&like=" + (amount > 0 ? "1" : "-1"));
	xhttp.send();
}

function	delete_comment(elem)
{
	var	xhttp;

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
		{
			if (this.responseText.startsWith("ERROR:"))
				console.log(this.responseText);
			else
				picture_show_overlay(active_id);
		}
	}
	xhttp.open("GET", "/scripts/administrative_functions.php?delete_type=comment"
		+ "&comment_id=" + elem.toElement.id);
	xhttp.send();
}
