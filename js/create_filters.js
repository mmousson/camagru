var filter_count = 0;
var editor = document.getElementById("the_image");
var add_btn = document.getElementById("add_btn");

function    add_filter_to_editor(path_to_filter_image)
{
    var new_filter_wrapper = document.createElement("div");
    var new_filter_image = document.createElement("img");
    // var resize_div = document.createElement("div");
    // var rotate_div = document.createElement("div");
    var resizers = document.createElement("div");
    var resizer_bottom_right = document.createElement("div");
    var delete_button = document.createElement("button");

    new_filter_wrapper.classList.add("my_filter");
    new_filter_wrapper.classList.add("resizable");
    new_filter_image.classList.add("my_filter_header");
    resizers.classList.add("resizers");
    resizer_bottom_right.classList.add("resizer");
    resizer_bottom_right.classList.add("bottom-right");

    new_filter_wrapper.id = "filter_" + filter_count + "_wrapper";
    new_filter_image.id = "filter_" + filter_count + "_wrapperheader";
    new_filter_image.src = path_to_filter_image;
    delete_button.id = "delete_btn_" + filter_count;
    delete_button.appendChild(document.createTextNode("DELETE"));
    delete_button.addEventListener("click", function (elem) {
        document.getElementById(elem.toElement.id).parentElement.remove();
    });

    // resize_div.classList.add("handle");
    // resize_div.classList.add("h_blue");
    // rotate_div.classList.add("handle");
    // rotate_div.classList.add("h_green");
    delete_button.classList.add("delete_btn");

    new_filter_wrapper.appendChild(new_filter_image);
    // new_filter_wrapper.appendChild(resize_div);
    // new_filter_wrapper.appendChild(rotate_div);
    new_filter_wrapper.appendChild(delete_button);
    new_filter_wrapper.appendChild(resizers);
    resizers.appendChild(resizer_bottom_right);
    editor.appendChild(new_filter_wrapper);

    drag_element(new_filter_wrapper);

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
        event = event || window.event;
        event.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = event.clientX;
        pos4 = event.clientY;
        document.onmouseup = close_drag;
        // call a function whenever the cursor moves:
        document.onmousemove = drag_element;
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

function makeResizableDiv(id)
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
        })
      
        function resize(e)
        {
            if (currentResizer.classList.contains('bottom-right'))
            {
                const width = original_width + (e.pageX - original_mouse_x);
                const height = original_height + (e.pageY - original_mouse_y)
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
            window.removeEventListener('mousemove', resize)
        }
    }
  }
  
  makeResizableDiv('filter_test')