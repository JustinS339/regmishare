<?php
	$ini_array = parse_ini_file("scripts/url.ini");
	$host = $ini_array["url"];
	
	session_start();
	ob_start();

	if(!isset($_SESSION['login_user'])){
		header("Location: ".$host."index.php");
		die();
	}
	echo "<h1>" . $_SESSION['login_user'] . "'s "
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/regmishare.js"></script>
</head>

<body>
	home page</h1>
	<button type="button">Upload File</button>
	<button type="button"><a href="scripts/logout.php">Log Out</a></button>
</body>

</html>