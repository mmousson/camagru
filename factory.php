<?php
include_once("header.php");
?>
<html>
	<meta charset="UTF-8"/>
	<head>
		<link rel="stylesheet" type="text/css" href="css/factory.css"/>
	</head>
	<body>
		<div class="editor_wrapper">
			<div class="image_settings">
				<h2 class="pannel_title">EFFECTS</h2>
				<div class="sliders">
					<div class="slider_wrapper">
						<p>
							<label for="gs">Grayscale</label>
						</p>
						<input class="slider_range" id="gs" name="gs" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="bl">Blur</label>
						</p>
						<input class="slider_range" id="bl" name="bl" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="br">Brightness</label>
						</p>
						<input class="slider_range" id="br" name="br" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="co">Contrast</label>
						</p>
						<input class="slider_range" id="co" name="co" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="hu">Hue Rotate</label>
						</p>
						<input class="slider_range" id="hu" name="hu" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="op">Opacity</label>
						</p>
						<input class="slider_range" id="op" name="op" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="in">Invert</label>
						</p>
						<input class="slider_range" id="in" name="in" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="sa">Saturation</label>
						</p>
						<input class="slider_range" id="sa" name="sa" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="se">Sepia</label>
						</p>
						<input class="slider_range" id="se" name="se" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<button id="reset_btn" class="btn red">RESET</button>
				</div>
			</div>
			<form id="box_wrapper" class="box" method="post" action="" enctype="multipart/form-data">
				<div class="box_input">
					<input class="box_file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple/>
					<label for="file"><img src="/images/UI/upload_icon.png"/><br/><strong>Choose a file</strong><span class="box_dragndrop"> or drag it here</span></label>
					<!-- <button class="box_button" type="submit">Upload</button> -->
				</div>
				<div class="box_uploading">Uploading&hellip;</div>
				<div class="box_success">Done !</div>
				<div class="box_error">Error ! <span></span>.</div>
			</form>
			<!-- <div id="the_image" class="image_preview">
				<div class="image_texts">
					<h1>Camagru Photo Edition</h1>
					<button id="upload_btn">UPLOAD AN IMAGE</button>
					<p>or</p>
					<button id="photo_btn">TAKE A PHOTO</button>
				</div>
			</div> -->
			<div class="image_filters" style="overflow-y: scroll;">
				<h2 class="pannel_title">FILTERS</h2>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
				<input type="image" id="trollface_filter" name="trollface_filter" src="/images/filters/trollface.png"/>
			</div>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/factory.js"></script>
</html>
