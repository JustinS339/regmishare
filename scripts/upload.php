<?php
session_start();
ob_start();

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
?>