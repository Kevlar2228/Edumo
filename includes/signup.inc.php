<?php
session_start();

if (isset($_POST['signupSubmit'])) {

     $uid = $_POST['uid'];
     $email = $_POST['email'];
     $pwd = $_POST['pwd'];
     $pwdRe = $_POST['pwdRe'];

     require 'db.inc.php';
     require 'functions.inc.php';

     if (emptyInputSignup($uid, $email, $pwd, $pwdRe) !== false) {
          $_SESSION['error'] = 'emptyfields';
          header('Location: /Edumo/signup.php');
          exit();
     }

     if (invalidUid($uid) !== false) {
          $_SESSION['error'] = 'invalidUid';
          header('Location: /Edumo/signup.php');
          exit();
     }

     if (invalidEmail($email) !== false) {
          $_SESSION['error'] = 'invalidEmail';
          header('Location: /Edumo/signup.php');
          exit();
     }

     if (pwdMatch($pwd, $pwdRe) !== false) {
          $_SESSION['error'] = 'pwdMatch';
          header('Location: /Edumo/signup.php');
          exit();
     }

     if (uidExists($conn, $uid, $email) !== false) {
          $_SESSION['error'] = 'uidExists';
          header('Location: /Edumo/signup.php');
          exit();
     }

     createUser($conn, $uid, $email, $pwd);

} else {
     $_SESSION['error'] = "noaccess";
     header('Location: /Edumo/signup.php');
     exit();
}
