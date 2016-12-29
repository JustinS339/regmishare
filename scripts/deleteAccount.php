<?php
session_start();
ob_start();

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
			unset($_COOKIE['username']);
			setcookie('username', '', time() - 3600, '/');
			header("Location: ../index.php");
		}
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