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
