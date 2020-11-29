<?php

require 'db.inc.php';
require 'functions.inc.php';
session_start();

if (isset($_POST['uploadProfilePicSubmit'])) {

     $idUsers = $_SESSION['idUsers'];
     $target_dir = "../profilePics/";
     $hash = $conn->escape_string( md5( rand(0,1000) ) );
     $target_file = $target_dir . basename($_FILES["upload"]["name"]);
     $uploadOk = 1;



     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

     // Check if image file is a actual image or fake image
     if(isset($_POST["submit"])) {
       $check = getimagesize($_FILES["upload"]["tmp_name"]);
       if($check !== false) {
         $uploadOk = 1;
       } else {
         error('nofile', 'uploadProfilePic.php');
         $uploadOk = 0;
       }
 }

     // Allow certain file formats
     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
     && $imageFileType != "gif" ) {
       error('wrongfiletype', 'uploadProfilePic.php');
       $uploadOk = 0;
     }

     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
       exit();
     // if everything is ok, try to upload file
     } else {
       if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_dir . $hash.'.'.$imageFileType)) {

            $sql = "UPDATE users SET picUsers=? WHERE idUsers=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                 error('sqlerror1', 'uploadProfilePic.php');
            }
            $url = $hash.'.'.$imageFileType;
            echo $url;
            mysqli_stmt_bind_param($stmt, "ss", $url, $idUsers);
            if (mysqli_stmt_execute($stmt)) {
                 error('none', 'profile.php');
            } else {
                 error('sqlerror1', 'uploadProfilePic.php');
            }

       } else {
         error('sqlerror2', 'uploadProfilePic.php');
       }
     }


} else {
     error('noaccess', 'uploadProfilePic.php');
}
