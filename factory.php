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
						<input id="gs" name="gs" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="bl">Blur</label>
						</p>
						<input id="bl" name="bl" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="br">Brightness</label>
						</p>
						<input id="br" name="br" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="co">Contrast</label>
						</p>
						<input id="co" name="co" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="hu">Hue Rotate</label>
						</p>
						<input id="hu" name="hu" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="op">Opacity</label>
						</p>
						<input id="op" name="op" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="in">Invert</label>
						</p>
						<input id="in" name="in" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="sa">Saturation</label>
						</p>
						<input id="sa" name="sa" type="range" min="0" max="100" value="100"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="se">Sepia</label>
						</p>
						<input id="se" name="se" type="range" min="0" max="100" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<button class="btn red">RESET</button>
				</div>
			</div>
			<div class="image_preview">
				<div class="image_texts">
					<h1>Camagru Photo Edition</h1>
					<button id="upload_btn">UPLOAD AN IMAGE</button>
					<p>or</p>
					<button id="photo_btn">TAKE A PHOTO</button>
				</div>
			</div>
			<div class="image_filters">
				<h2 class="pannel_title">FILTERS</h2>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="js/factory.js"></script>
</html>
