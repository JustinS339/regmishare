<?php
	$ini_array = parse_ini_file("scripts/url.ini");
	$host = $ini_array["url"];
	
	session_start();
	ob_start();

	if(!isset($_SESSION['login_user'])){
		header("Location: ".$host."index.php");
		die();
	}

	echo "<div style=\"text-transform: uppercase;\"><b> <font size=\"+2\">" . $_SESSION['login_user'] . "'s home page</font></b></div><br>";
	echo "<div> Your files: </div><br>";

	$path = 'uploads/'.$_SESSION['login_user'];

	$files = scandir($path);

	if(count(array_slice($files, 2))==0){
		echo("No files uploaded yet <br>");
	}

	foreach (array_slice($files, 2) as $value) {
	    echo '<a href="uploads/'.$_SESSION['login_user'].'/'.$value.'" download target="_blank">'.$value.'</a><br/>';
	}
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/regmishare.js"></script>
</head>

<body>
	<br><button type="button"><a href="scripts/logout.php">Log Out</a></button> <hr><br>

	<form action="scripts/upload.php" method="post" enctype="multipart/form-data">
	    Select file to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload" name="submit">
	</form>
</body>

</html>