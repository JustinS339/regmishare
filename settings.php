<?php
	session_start();
	ob_start();

	if(!isset($_SESSION['login_user'])){
		header("Location: index.php");
		die();
	}
	echo '<head>
	<title> Regmishare </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
	<script type="text/javascript" src="scripts/regmishare.js"></script>
	<link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="/images/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	</head>';
	echo '<a href="home.php"><div class="titleTop"></div></a>';
	echo "<span class=\"headerText\" style=\"text-transform: uppercase;\"><b> <font size=\"+5\">" . $_SESSION['login_user'] . "'s settings page</font></b></span>";
?>

<!doctype html>

<html>

<body>
	<a href="scripts/logout.php" class="nolink"><button type="button" style="position: absolute; right: 0; margin-right: 2em; margin-top: 1.5em;" class="regularButton">Log Out</button></a><hr>
	
	<section class="loginform cf" style="margin-top: 7em;">
		<a href="changePassword.php" class="nolink"><button type="button" class="regularButton" id="centerButton">Change Password</button></a>
		<hr>
		<div style="text-align: center;"><b>WARNING: This action is irreversible and will delete all the files that you have uploaded</b></div><br>
		<form action="scripts/deleteAccount.php" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Please indicate that you understand the consequences of deleting your account'); return false; }">
			<div id="centerAgree"><input type="checkbox" name="checkbox" value="check" id="agree" />I understand the consequences</div><br><br>
			<input type="submit" id="centerWarningButton" name="submit" value="Delete Account" style="margin: auto;"/>
		</form>
	</section>
</body>

</html>