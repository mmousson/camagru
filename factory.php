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
						<input class="slider_range" id="gs" name="gs" type="range" min="0" max="1" value="0"/>
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
							<label for="in">Invert</label>
						</p>
						<input class="slider_range" id="in" name="in" type="range" min="0" max="1" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<div class="slider_wrapper">
						<p>
							<label for="se">Sepia</label>
						</p>
						<input class="slider_range" id="se" name="se" type="range" min="0" max="1" value="0"/>
						<span class="slider_span">0</span>
					</div>
					<button id="reset_btn" class="btn red">RESET</button>
				</div>
			</div>

			<div id="center_pannel">

				<form id="box_wrapper" class="box" method="post" action="" enctype="multipart/form-data">
					<div class="box_input">
						<input class="box_file" type="file" name="files[]" id="file"/>
						<label for="file"><img src="/images/UI/upload_icon.png"/><br/><strong>Choose an image</strong><span class="box_dragndrop"> or drag it here<br/><br/>OR</span></label>
						<div id="submit_button_wrapper">
							<button id="submit_button" class="box_button" type="button">TAKE A WEBCAM SNAPSHOT</button>
						</div>
					</div>

					<div class="box_uploading">Uploading&hellip;</div>

					<div class="box_success">Done !</div>

					<div class="box_error">Error ! <span></span>.</div>
				</form>

				<div id="the_image" class="image_preview">
				</div>

				<div id="the_webcam">
					<video id="video" autoplay="true">
					</video>
					<canvas id="webcam_canvas" style="display: none;"></canvas>
					<input id="take_webcam_snapshot" type="image" src="/images/UI/webcam_snapshot.png"/>
				</div>

				<div id="controls">
					<form>
						<div id="textarea_wrapper">
							<textarea id="subject" name="subject" type="text" placeholder="Enter a caption for your post here..." maxlength="300" required></textarea>
						</div>
						<button id="send_image_data_btn" type="button">PUSBLISH</button>
					</form>
				</div>

			</div>

			<div class="image_filters" style="overflow-y: scroll;">
				<h2 class="pannel_title">FILTERS</h2>
				<?php
					function endsWith($string, $endString) 
					{ 
						$len = strlen($endString); 
						if ($len == 0) { 
							return true; 
						}
						return (substr($string, -$len) === $endString); 
					} 

					$files = scandir("images/filters");
					foreach ( $files as $name )
					{
						if ( endsWith($name, ".png") )
						{
							$id = explode( ".", $name )[0] . "_filter";
							echo '<input type="image" id="' . $id . '" name="' . $id . '" src="/images/filters/' . $name . '" onclick="add_filter_to_editor(' . "'" . "images/filters/" . $name . "'" . ")\"" . '/>';
						}
					}
				?>
			</div>
		</div>

		<div id="overlay">
			<div class="dialog">
				<img id="status_logo" class="status" src="/images/UI/checkmark_processing.png"/>
				<p id="dialog_title_txt" class="title">Image Processing Complete</p>
				<p id="question_txt" class="question">Are you sure you want to publish your creation ?</p>
				<button id="cancel_btn" class="cancel" type="button">No, I don't want to</button>
				<button id="confirm_btn" class="confirm" type="button">Yes, I do want to publish this creation</button>
				<div id="public_confirm">
					<input type="checkbox" id="make_public" name="make_public" checked/>
					<label for="">Make this post public</label>
				</div>
				<button id="ok_btn" class="confirm" type="button">OK</button>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="/js/factory.js"></script>
	<script type="text/javascript" src="/js/webcam.js"></script>
	<script type="text/javascript" src="/js/create_filters.js"></script>
	<script type="text/javascript" src="/js/send_factory_data.js"></script>
</html>
