var filter_count = 0;
var editor = document.getElementById("the_image");
var add_btn = document.getElementById("add_btn");
var resizing = false;

function    add_filter_to_editor(path_to_filter_image)
{
    var new_filter_wrapper = document.createElement("div");
    var resizers = document.createElement("div");
	var resizer_bottom_right = document.createElement("div");
    var	delete_top_left = document.createElement("div");
    var flip_image_top_right = document.createElement("div");

    new_filter_wrapper.classList.add("my_filter");
    new_filter_wrapper.classList.add("resizable");
    resizers.classList.add("resizers");
    resizer_bottom_right.classList.add("resizer");
	resizer_bottom_right.classList.add("bottom-right");
	delete_top_left.classList.add("delete_filter");
    delete_top_left.classList.add("top-left");
    flip_image_top_right.classList.add("flip_image");
    flip_image_top_right.classList.add("top-right");

    new_filter_wrapper.id = "filter_" + filter_count + "_wrapper";
    flip_image_top_right.id = "flip_img_" + filter_count;
    new_filter_wrapper.style.backgroundImage = "url(" + path_to_filter_image + ")";
    new_filter_wrapper.style.backgroundRepeat = "no-repeat";
	new_filter_wrapper.style.backgroundSize = "cover";
	new_filter_wrapper.style.cursor = "move";
	delete_top_left.id = "delete_btn_" + filter_count;

    new_filter_wrapper.appendChild(resizers);
	resizers.appendChild(resizer_bottom_right);
    resizers.appendChild(delete_top_left);
    resizers.appendChild(flip_image_top_right);
	delete_top_left.appendChild(document.createTextNode("X"));
	delete_top_left.addEventListener("click", function (elem) {
		document.getElementById(elem.toElement.id).parentElement.parentElement.remove();
    });
    flip_image_top_right.addEventListener("click", function (elem) {
        var rotation;

        if (document.getElementById(elem.toElement.id).parentElement.parentElement.style.transform == "rotateY(180deg)")
        {
            document.getElementById(elem.toElement.id).style.right = "-5px";
            document.getElementById(elem.toElement.id).style.setProperty("left", "initial");
            document.getElementById(elem.toElement.id).parentElement.childNodes[0].style.right = "-5px";
            document.getElementById(elem.toElement.id).parentElement.childNodes[0].style.setProperty("left", "initial");
            document.getElementById(elem.toElement.id).parentElement.childNodes[1].style.left = "-5px";
            document.getElementById(elem.toElement.id).parentElement.childNodes[1].style.setProperty("right", "initial");

            rotation = "";
        }
        else
        {
            document.getElementById(elem.toElement.id).style.left = "-5px";
            document.getElementById(elem.toElement.id).style.setProperty("right", "initial");
            document.getElementById(elem.toElement.id).parentElement.childNodes[0].style.setProperty("right", "initial");
            document.getElementById(elem.toElement.id).parentElement.childNodes[0].style.left = "-5px";
            document.getElementById(elem.toElement.id).parentElement.childNodes[1].style.right = "-5px";
            document.getElementById(elem.toElement.id).parentElement.childNodes[1].style.setProperty("left", "initial");

            rotation = "rotateY(180deg)";
        }
        document.getElementById(elem.toElement.id).parentElement.parentElement.style.transform = rotation;
    });

    editor.appendChild(new_filter_wrapper);

    drag_element(new_filter_wrapper);
    make_resizable_div(new_filter_wrapper.id);

    filter_count++;
}

function    drag_element(elem)
{
    var pos1 = 0;
    var pos2 = 0;
    var pos3 = 0;
    var pos4 = 0;

    if (document.getElementById(elem.id + "header"))
        document.getElementById(elem.id + "header").onmousedown = drag_mouse_down;
    else
        elem.onmousedown = drag_mouse_down;

    function    drag_mouse_down(event)
    {
        if (!resizing)
        {
            event = event || window.event;
            event.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = event.clientX;
            pos4 = event.clientY;
            document.onmouseup = close_drag;
            // call a function whenever the cursor moves:
            document.onmousemove = drag_element;
        }
    }

    function    drag_element(event)
    {
        event = event || window.event;
        event.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - event.clientX;
        pos2 = pos4 - event.clientY;
        pos3 = event.clientX;
        pos4 = event.clientY;
        // set the element's new position:
        elem.style.top = (elem.offsetTop - pos2) + "px";
        elem.style.left = (elem.offsetLeft - pos1) + "px";
    }

    function    close_drag()
    {
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

function make_resizable_div(id)
{
    const element = document.getElementById(id);
    const resizers = document.querySelectorAll("#" + id + " .resizer");
    const minimum_size = 20;
    let original_width = 0;
    let original_height = 0;
    let original_mouse_x = 0;
    let original_mouse_y = 0;
    for (let i = 0;i < resizers.length; i++)
    {
        const currentResizer = resizers[i];
        currentResizer.addEventListener('mousedown', function(e) {
            e.preventDefault()
            original_width = parseFloat(getComputedStyle(element, null).getPropertyValue('width').replace('px', ''));
            original_height = parseFloat(getComputedStyle(element, null).getPropertyValue('height').replace('px', ''));
            original_x = element.getBoundingClientRect().left;
            original_y = element.getBoundingClientRect().top;
            original_mouse_x = e.pageX;
            original_mouse_y = e.pageY;
            window.addEventListener('mousemove', resize)
            window.addEventListener('mouseup', stopResize)
            resizing = true;
        })
      
        function resize(e)
        {
            if (currentResizer.classList.contains('bottom-right'))
            {
                var width = original_width + (e.pageX - original_mouse_x);
				var height = original_height + (e.pageY - original_mouse_y)
				if (width > height)
					height = width;
				else if (height > width)
					width = height;
                if (width > minimum_size)
                {
                    element.style.width = width + 'px'
                }
                if (height > minimum_size)
                {
                    element.style.height = height + 'px'
                }
            }
        }
        
        function stopResize()
        {
            resizing = false;
            window.removeEventListener('mousemove', resize)
        }
    }
  }
