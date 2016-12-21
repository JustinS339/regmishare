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
	echo '<div class="titleTop"></div>';
	echo "<span class=\"headerText\" style=\"text-transform: uppercase;\"><b> <font size=\"+5\">" . $_SESSION['login_user'] . "'s home page</font></b></span>";
	echo '<a href="settings.php" class="nolink"><button type="button" style="position: absolute; right: 0; margin-right: 8em; margin-top: 1.5em;" class="regularButton">Settings</button></a>';
	echo '<a href="scripts/logout.php" class="nolink"><button type="button" style="position: absolute; right: 0; margin-right: 2em; margin-top: 1.5em;" class="regularButton">Log Out</button></a><hr>';
	echo '<section style="font-weight: bold; margin-top: 3em;" class="loginform cf">';
	echo '<form action="scripts/upload.php" method="post" enctype="multipart/form-data">
		    Select file to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload" required>
		    <input type="submit" value="Upload" name="submit">
		</form>
		<hr>';

	echo "<div><h3> Your files: </h3></div>";

	$path = 'uploads/'.$_SESSION['login_user'];

	$files = scandir($path);

	if(count(array_slice($files, 2))==0){
		echo("<span style= 'font-weight: normal;'>No files uploaded yet </span><br>");
	}
	echo '<hr>';

	foreach (array_slice($files, 2) as $value) {
	    //echo '<a href="uploads/'.$_SESSION['login_user'].'/'.$value.'" download target="_blank">'.$value.'</a><br/>';
	    echo '<span style= "font-weight: normal;">' .$value.'</span>';
	    echo '<form enctype="multipart/form-data" action="scripts/download.php" method="post" style="display:inline;">
            <input type="hidden" name="filename" value="'.$value.'"/>
            <input type="submit" id="downloadButton" name="download" value="Download" id="hyperlink-style-button"/>
        </form>';
        echo '<form enctype="multipart/form-data" action="scripts/deleteFile.php" method="post" style="display:inline;">
            <input type="hidden" name="filename" value="'.$value.'"/>
            <input type="submit" id="deleteButton" name="delete" value="Delete" id="hyperlink-style-button"/>
        </form>';
        echo '<br><br>';
	}
	echo '</section>';
?>

<!doctype html>

<html>

</html>