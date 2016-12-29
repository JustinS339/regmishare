<?php
	include_once("scripts/constants.php");
	session_start();
	ob_start();

	if(isset($_SESSION['login_user'])){
		header("Location: home.php");
		die();
	}
	if(!isset($_SESSION['login_user']) && !isset($_COOKIE['username'])){
		header("Location: index.php");
		die();
	}

	echo '<script type="text/javascript" src="scripts/regmishare.js"></script>

	<div class="title"></div>

	<section class="loginform cf">
		<div><span style="text-transform: uppercase;">'.$_COOKIE['username'].'</span>, you have been inactive for over '.TIMEOUTTEXT.'. Please enter your password for security purposes.</div><br>
		<form name="login" id="login" onsubmit = "return attemptLogin(this);" method="post" accept-charset="utf-8">
				<input type="hidden" name="username" value="'.$_COOKIE['username'].'"/>
				<input type="password" name="password" id="password" placeholder="password" required>
				</br>
				<input type="submit" style="margin-left: 0.5em;" value="Login" id="btn">		
				<a href="/index.php" style="float: right; padding-top: 1.7em;">Use another account?</a>
		</form>
	</section>';
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="/images/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>

</html>