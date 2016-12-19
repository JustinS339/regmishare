<?php
	session_start();
	ob_start();

	if(!isset($_SESSION['login_user'])){
		header("Location: index.php");
		die();
	}
	echo "<div style=\"text-transform: uppercase;\"><b> <font size=\"+2\">" . $_SESSION['login_user'] . "'s settings page</font></b></div><br>";
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/regmishare.js"></script>
</head>

<body>
	<button type="button"><a href="home.php">Home</a></button>
	<button type="button"><a href="scripts/logout.php">Log Out</a></button><hr>
	<button type="button"><a href="changePassword.php">Change Password</a></button><hr>

	<div>WARNING: IRREVERSIBLE (Deletes all uploaded files too)</div><br>

	<form action="scripts/deleteAccount.php" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Please indicate that you understand the consequences of deleting your account'); return false; }">
		<input type="checkbox" name="checkbox" value="check" id="agree" /> I understand the consequences
		<br><br>
		<input type="submit" name="submit" value="Delete Account" />
	</form>

	<br>
	<hr>
</body>

</html>