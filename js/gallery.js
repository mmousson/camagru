var	mosaic_18 = document.getElementById("18");
var	mosaic_6 = document.getElementById("6");
var	mosaic_1 = document.getElementById("1");

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
				element.src = element.src.replace("normal", "pressed");
			else if (element.src.includes("pressed") && element != that_one)
				element.src = element.src.replace("pressed", "normal");
		});
	}
}

mosaic_1.addEventListener("click", gallery_mosaic_event_handler);
mosaic_6.addEventListener("click", gallery_mosaic_event_handler);
mosaic_18.addEventListener("click", gallery_mosaic_event_handler);
