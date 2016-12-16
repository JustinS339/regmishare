<?php
session_start();
ob_start();

$file = "../uploads/".$_SESSION['login_user']."/".$_POST['filename'];

if(!empty($_POST['filename'])){
	if(isset($_SESSION['login_user'])){
		if (file_exists($file)){
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);
		    exit;
		}
	}
}
die( "ERROR: invalid file or you don't have permissions to download it." );
?>