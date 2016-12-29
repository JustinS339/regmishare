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

        $target_dir = "../uploads/".$_SESSION['login_user']."/";

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            echo '<script type="text/javascript"> confirm("File with same name already exists");</script>';
            $uploadOk = 0;
        }
        // Check file size
        //if ($_FILES["fileToUpload"]["size"] > 500000) {
        //    echo "Sorry, your file is too large. (>500kb)";
        //    $uploadOk = 0;
        //}

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<script type="text/javascript"> confirm("Sorry, your file was not uploaded");';
            echo 'window.location= "../home.php";</script>';
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                header("Location: ../home.php");
                die();
            } else {
                echo '<script type="text/javascript"> confirm("Sorry, there was an error uploading your file");';
                echo 'window.location= "../home.php";</script>';
            }
        }

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