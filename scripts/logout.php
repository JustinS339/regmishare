<?php
	session_start();
	ob_start();
	if(session_destroy()){
		header("Location: http://dev.regmi.biz/index.php"); // Redirecting To Home Page
	}
?>