<?php
	$ini_array = parse_ini_file("scripts/url.ini");
	$host = $ini_array["url"];

	session_start();
	ob_start();

	if(isset($_SESSION['login_user'])){
		header("Location: ".$host."home.php");
		die();
	}
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
	<div id="background">
		<!--img src="images/bg.jpg" class="stretch" alt="" /-->
	</div>
	<script type="text/javascript" src="scripts/regmishare.js"></script>

	<section class="loginform cf">
	<form name="login" id="login" onsubmit = "return attemptLogin(this);" method="post" accept-charset="utf-8">
			<label for="username">Username:</label>
			<input type="username" name="username" id="username" placeholder="username" required>
			</br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" placeholder="password" required>
			</br>
			<input type="submit" value="Login" id="btn">		
	</form>
	</section>
</body>

</html>