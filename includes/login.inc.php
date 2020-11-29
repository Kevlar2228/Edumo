Edumo<?php

if (isset($_POST['loginSubmit'])) {

     $uidEmail = $_POST['uidemail'];
     $pwd = $_POST['pwd'];

     session_start();

     require 'db.inc.php';
     require 'functions.inc.php';

     if (emptyInputLogin($uidEmail, $pwd) !== false) {
          $_SESSION['error'] = 'emptyfields';
          header('Location: /Edumo/login.php');
          exit();
     }

     loginUser($conn, $uidEmail, $pwd);

} else {
     $_SESSION['error'] = "noaccess";
     header('Location: /Edumo/signup.php');
     exit();
}
