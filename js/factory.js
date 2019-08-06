var	dropped_file = null;
var	form = document.getElementById("box_wrapper");
var	submit_btn = document.getElementById("submit_button");
var	file_input = document.getElementById("file");

var rangeSlider = function(){
	var slider = $('.slider_wrapper'),
	range = $('.slider_range'),
	value = $('.slider_span');

	slider.each(function(){
		value.each(function(){
			var value = $(this).prev().attr('value');
			$(this).html(value);
		});
		range.on('input', function(){
			$(this).next(value).html(this.value);
		});
	});
};
rangeSlider();

var			is_advanced_upload = function () {
	var	div = document.createElement("div");

	return (('draggable' in div)
		|| ('ondragstart' in div && 'ondrop' in div)
		&& ('FormData' in window)
		&& ('FileReader' in window));
}();

function	edit_image()
{
	var	gs = $("#gs").val();
	var	bl = $("#bl").val();
	var	br = $("#br").val();
	var	co = $("#co").val();
	var	hu = $("#hu").val();
	var	op = $("#op").val();
	var	_in = $("#in").val();
	var	sa = $("#sa").val();
	var	se = $("#se").val();

	var filter =	'grayscale(' + gs +
					'%) blur(' + bl +
					'px) brightness(' + br +
					'%) contrast(' + co +
					'%) hue-rotate(' + hu +
					'deg) opacity(' + op +
					'%) invert(' + _in +
					'%) saturate(' + sa +
					'%) sepia(' + se +
					'%)';
	$("#the_image").css("filter", filter);
	$("#the_image").css("filter", filter);
}

$("input[type=range]").change(edit_image).mousemove(edit_image);
$("#reset_btn").click(function () {
	$("#gs").val("0");
	$("#bl").val("0");
	$("#br").val("100");
	$("#co").val("100");
	$("#hu").val("0");
	$("#op").val("100");
	$("#in").val("0");
	$("#sa").val("100");
	$("#se").val("0");
	rangeSlider();
	edit_image();
});

if (is_advanced_upload)
{
	var	form;

	var	wrapper = document.getElementById("box_wrapper");
	if (wrapper != null)
		wrapper.classList.add("has_advanced_upload");

	form.addEventListener("drag", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);
	form.addEventListener("dragstart", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);
	form.addEventListener("dragend", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);
	form.addEventListener("dragover", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);
	form.addEventListener("dragenter", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);
	form.addEventListener("dragleave", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);
	form.addEventListener("drop", drag_dragstart_dragend_dragenter_dragleave_drop_events, false);

	form.addEventListener("dragover", dragover_dragenter, false);
	form.addEventListener("dragenter", dragover_dragenter, false);

	form.addEventListener("dragleave", dragleave_dragend_drop, false);
	form.addEventListener("dragend", dragleave_dragend_drop, false);
	form.addEventListener("drop", dragleave_dragend_drop, false);

	form.addEventListener("drop", drop_event, false);
}

file_input.addEventListener("change", function () {
	// this.value = null;
	if (form.classList.contains("is_uploading"))
		return false;
	form.classList.add("is_uploading");
	form.classList.remove("is_error");

	if (is_advanced_upload)
	{
		var	xhttp;
		var	form_data;

		xhttp = new XMLHttpRequest();
		form_data = new FormData(form);
		console.log("Form Data: ", form_data);
		xhttp.open("POST", "/scripts/upload_image.php", true);
		xhttp.onreadystatechange = function () {
			if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
			{
				form.classList.remove("is_uploading");
				if (this.responseText.startsWith("ERROR: "))
					console.log("AN ERROR OCCURED: ", this.responseText);
				else
					set_background_image(this.responseText);
			}
		}
		xhttp.send(form_data);
	}
	else
	{
		console.log("NOT ADVANCED UPLOAD");
	}
});

function	drag_dragstart_dragend_dragenter_dragleave_drop_events(e) {
	e.preventDefault();
	e.stopPropagation();
}

function	dragover_dragenter() { form.classList.add("is_dragover"); }
function	dragleave_dragend_drop() { form.classList.remove("is_dragover"); }
function	drop_event(e) {
	dropped_file = e.dataTransfer.files;
}

function	set_background_image(full_path)
{
	var	editor = document.getElementById("the_image");

	editor.style.display = "block";
	editor.style.backgroundImage = "url(" + full_path + ")";
	editor.style.backgroundPosition = "center";
	editor.style.backgroundRepeat = "no-repeat";
	editor.style.backgroundSize = "contain";
	form.style.display = "none";
}

function	resize()
{
	var	width;

	box_wrapper = document.getElementById("box_wrapper");
	the_image = document.getElementById("the_image");
	the_webcam =  document.getElementById("the_webcam");
	width = box_wrapper.clientWidth;
	if (width == 0)
		width = the_image.clientWidth;
	if (width == 0)
		width = the_webcam.clientWidth;
	box_wrapper.style.height = width / 16 * 9;
	the_image.style.height =  width / 16 * 9;
	the_webcam.style.height = width / 16 * 9;
	document.getElementById("textarea_wrapper").style.height = "calc(100% - 60px)";
}
resize();
window.onresize = resize;
