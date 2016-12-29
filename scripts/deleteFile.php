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

if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}

if (!empty($_POST['CSRFToken'])) {
    if (hash_equals($_SESSION['token'], $_POST['CSRFToken'])) {
         // Proceed to process the form data

		$file = "../uploads/".$_SESSION['login_user']."/".$_POST['filename'];
		unlink($file);
		echo "The file has been deleted.";
		header("Location: ../home.php");
		die();

	} else {
         // Log this as a warning and keep an eye on these attempts
        echo '<script type="text/javascript"> confirm("Invalid CSRF Token");';
        echo 'window.location= "../home.php";</script>';
        throw new Exception("Invalid CSRF token.");
    }
}
else{
    echo '<script type="text/javascript">';
    echo 'window.location= "../home.php";</script>';
}
?>