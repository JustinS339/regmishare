<?php
	session_start();
	ob_start();

	if(!isset($_SESSION['login_user'])){
		header("Location: index.php");
		die();
	}

	echo "<div style=\"text-transform: uppercase;\"><b> <font size=\"+2\">" . $_SESSION['login_user'] . "'s home page</font></b></div>";
	echo '<br><button type="button"><a href="settings.php">Settings</a></button>';
	echo '<button type="button"><a href="scripts/logout.php">Log Out</a></button><hr>

		<form action="scripts/upload.php" method="post" enctype="multipart/form-data">
		    Select file to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <input type="submit" value="Upload" name="submit">
		</form>
		<hr>';

	echo "<div><h3> Your files: </h3></div>";

	$path = 'uploads/'.$_SESSION['login_user'];

	$files = scandir($path);

	if(count(array_slice($files, 2))==0){
		echo("No files uploaded yet <br>");
	}
	echo '<hr>';

	foreach (array_slice($files, 2) as $value) {
	    //echo '<a href="uploads/'.$_SESSION['login_user'].'/'.$value.'" download target="_blank">'.$value.'</a><br/>';
	    echo $value;
	    echo '<form enctype="multipart/form-data" action="scripts/download.php" method="post" style="display:inline;">
            <input type="hidden" name="filename" value="'.$value.'"/>
            <input type="submit" name="download" value="Download" id="hyperlink-style-button"/>
        </form>';
        echo '<form enctype="multipart/form-data" action="scripts/deleteFile.php" method="post" style="display:inline;">
            <input type="hidden" name="filename" value="'.$value.'"/>
            <input type="submit" name="delete" value="Delete" id="hyperlink-style-button"/>
        </form>';
        echo '<br><br>';
	}
?>

<!doctype html>

<html>

<head>
	<title> Regmishare </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/regmishare.js"></script>
</head>

</html>