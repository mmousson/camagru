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
