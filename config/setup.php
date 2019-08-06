<?php
	if ( mkdir("../uploads") === FALSE )
		echo "Failed to create 'uploads' folder. You should create this folder at the root of the server manually";
	if ( mkdir("../posts") === FALSE )
		echo "Failed to create 'posts' folder. You should create this folder at the root of the server manually";
?>