<?php
	$ini_array = parse_ini_file("url.ini");
	$host = $ini_array["url"];

	session_start();
	ob_start();
	if(session_destroy()){
		header("Location: ".$host."index.php");
	}
?>