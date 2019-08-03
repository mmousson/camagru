<?php
	function check_file_uploaded_name ( $filename )
	{
		(bool) ((preg_match("`^[-0-9A-Za-z_\.]+$`i",$filename)) ? true : false);
	}

	function check_file_uploaded_length ( $filename )
	{
		return (bool) ((mb_strlen($filename,"UTF-8") > 225) ? true : false);
	}

	function endsWith($string, $endString) 
	{ 
		$len = strlen($endString); 
		if ($len == 0) { 
			return true; 
		} 
		return (substr($string, -$len) === $endString); 
	} 

	function check_file_type( $file_path )
	{
		$type = mime_content_type( $file_path );
		if ( strcmp( $type, "image/jpeg" ) !== 0
			&& strcmp( $type, "image/png" ) !== 0 )
			return ( TRUE );
		if ( endsWith( $file_path, ".jpg" ) !== TRUE
			&& endsWith( $file_path, ".jpeg" ) !== TRUE
			&& endsWith( $file_path, ".png" ) !== TRUE )
		return ( FALSE );
	}

	set_time_limit(0);
	ini_set('upload_max_filesize', '500M');
	ini_set('post_max_size', '500M');
	ini_set('max_input_time', 4000); // Play with the values
	ini_set('max_execution_time', 4000); // Play with the values
	$uploads_folder = "../uploads";

	if ( $_FILES['files']['error'][0] === 0 )
	{
		$full_tmp_name = $_FILES['files']['tmp_name'][0];
		$tmp_name = basename( $_FILES['files']['name'][0] );

		if ( check_file_uploaded_name( $tmp_name ) === TRUE
			|| check_file_uploaded_length( $tmp_name ) === TRUE )
			echo "ERROR: Illegal characters detected in file name ! File has been dropped and this incident will be reported";
		else if ( check_file_type( $full_tmp_name ) === TRUE )
			echo "ERROR: Bad file type";
		else
		{
			if ( move_uploaded_file( $full_tmp_name, "$uploads_folder/$tmp_name" ) === TRUE )
				echo "$uploads_folder/$tmp_name";
			else
				echo "ERROR: Upload failed";
		}
	}
	else
		echo "ERROR: " . $_FILES['files']['error'][0];
?>