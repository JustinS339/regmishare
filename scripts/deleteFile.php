<?php
session_start();
ob_start();

$file = "../uploads/".$_SESSION['login_user']."/".$_POST['filename'];
unlink($file);
echo "The file has been deleted.";
header("Location: ../home.php");
die();
?>