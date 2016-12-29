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
$ini_array = parse_ini_file("databaseInfo.ini");

$sqlservername = $ini_array["sqlservername"];
$sqlusername = $ini_array["sqlusername"];
$sqlpassword = $ini_array["sqlpassword"];
$sqldatabase = $ini_array["sqldatabase"];

function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
{
    $algorithm = strtolower($algorithm);
    if(!in_array($algorithm, hash_algos(), true))
        trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
    if($count <= 0 || $key_length <= 0)
        trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

    if (function_exists("hash_pbkdf2")) {
        // The output length is in NIBBLES (4-bits) if $raw_output is false!
        if (!$raw_output) {
            $key_length = $key_length * 2;
        }
        return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
    }

    $hash_length = strlen(hash($algorithm, "", true));
    $block_count = ceil($key_length / $hash_length);

    $output = "";
    for($i = 1; $i <= $block_count; $i++) {
        // $i encoded as 4 bytes, big endian.
        $last = $salt . pack("N", $i);
        // first iteration
        $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
        // perform the other $count - 1 iterations
        for ($j = 1; $j < $count; $j++) {
            $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
        }
        $output .= $xorsum;
    }

    if($raw_output)
        return substr($output, 0, $key_length);
    else
        return bin2hex(substr($output, 0, $key_length));
}

// If bad information is somehow entered, handle it
$password1 = filter_var(mysql_escape_string($_POST['postpassword1']));
$password2 = filter_var(mysql_escape_string($_POST['postpassword2']));

$regexp = "/^[\\x00-\\x7F]{6,16}$/";
    $con = new mysqli($sqlservername,$sqlusername,$sqlpassword,$sqldatabase); 
    
//RETRIEVE USER INFO FROM DATABASE
$query = sprintf("SELECT * FROM userInfo WHERE username = '%s';", $_SESSION['login_user']);
$result = $con->query($query);
$row = $result->fetch_assoc();
$db_pw = $row["pass"];
$dbsalt = $row["salt"];

$hashedOldPassword = pbkdf2("sha256", $password1, $dbsalt, 1000, 32); 

if($hashedOldPassword !== $db_pw){
    $status = "Old password is incorrect";
}
else if($password1 === $password2){
    $status = "New password is the same as the old password";
}
else if(!preg_match($regexp, $password2)){
    $status = "New password must be 6 to 16 characters in length";
}
else{ 
    
	//NEW SALT GENERATION
	$salt = openssl_random_pseudo_bytes (32); 
    $hexsalt = bin2hex($salt); 

    //HASH NEW PASSWORD
    $hash = pbkdf2("sha256", $password2, $hexsalt, 1000, 32);

    //INSERT PASSWORD HASH AND SALT INTO DATABASE
    $query = "UPDATE userInfo SET pass='".$hash."', salt='".$hexsalt."' WHERE username='".$_SESSION['login_user']."'";
    $con->query($query);

    $status = 1;
}

$con->close();
echo json_encode($status);
?>