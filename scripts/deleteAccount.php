<?php
session_start();
ob_start();

$ini_array = parse_ini_file("databaseInfo.ini");

$sqlservername = $ini_array["sqlservername"];
$sqlusername = $ini_array["sqlusername"];
$sqlpassword = $ini_array["sqlpassword"];
$sqldatabase = $ini_array["sqldatabase"];

$con = new mysqli($sqlservername,$sqlusername,$sqlpassword,$sqldatabase); 

$path = "../uploads/".$_SESSION['login_user'];
array_map('unlink', glob("$path/*.*"));
rmdir($path);

$query = "DELETE FROM userInfo WHERE username = \"".$_SESSION['login_user']."\";";
$con->query($query);
$con->close();

if(session_destroy()){
	header("Location: ../index.php");
}
die();
?>