<?php
	session_start();
	ob_start();
	if(session_destroy()){
		unset($_COOKIE['username']);
		setcookie('username', '', time() - 3600, '/');
		header("Location: ../index.php");
	}
?>