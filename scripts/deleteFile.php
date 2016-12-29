<?php
include_once("constants.php");
session_start();
ob_start();

if(!isset($_SESSION['login_user'])){
	header("Location: ../index.php");
	die();
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > TIMEOUT)) {
    // last request was more than 30 minutes ago
    setcookie('username', $_SESSION['login_user'], time()+60*60*24, '/');
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header("Location: ../relogin.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}

$file = "../uploads/".$_SESSION['login_user']."/".$_POST['filename'];
unlink($file);
echo "The file has been deleted.";
header("Location: ../home.php");
die();
?>