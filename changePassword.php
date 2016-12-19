<?php
	session_start();
	ob_start();

	if(!isset($_SESSION['login_user'])){
		header("Location: index.php");
		die();
	}
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
	<script type="text/javascript" src="scripts/regmishare.js"></script>

	<div style=\"text-transform: uppercase;\"><b> <font size="+2">Password Change</font></b></div><br>
	<button type="button"><a href="settings.php">Settings</a></button>
	<button type="button"><a href="home.php">Home</a></button>
	<button type="button"><a href="scripts/logout.php">Log Out</a></button>
	<hr>

	<section class="loginform cf">
	<form name="passChange" id="passChange" onsubmit = "return attemptPasswordChange(this);" method="post" accept-charset="utf-8">
			<label for="oldPassword">Type old password:</label>
			<input type="password" name="password1" id="password1" placeholder="old password" required>
			</br>
			<label for="newPassword">Type new password:</label>
			<input type="password" name="password2" id="password2" placeholder="new password" required>
			</br>
			<label for="retypedNewPassword">Re-type new password:</label>
			<input type="password" name="password3" id="password3" placeholder="new password" required>
			</br>
			<input type="submit" value="Change Password" id="btn">		
	</form>
	</section>
</body>

</html>