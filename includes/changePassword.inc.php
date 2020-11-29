<?php

if (isset($_POST['changeAssignmentSubmit'])) {

     session_start();
     require 'db.inc.php';
     require 'functions.inc.php';

     $idUsers = $_SESSION['idUsers'];
     $user = getData($conn, 'users', 'idUsers', $idUsers);

     $pwdLast = $_POST['pwdLast'];
     $pwd = $_POST['pwd'];
     $pwdRe = $_POST['pwdRe'];

     if (!emptyPwdChange($pwdLast, $pwd, $pwdRe) == false) {
          $_SESSION['error'] = 'emptyfields';
          header("Location: /Edumo/changePassword.php");
          exit();
     }

     if (!pwdCheck($pwdLast, $user['pwdUsers']) == true) {
          $_SESSION['error'] = 'pwdCheck';
          header("Location: /Edumo/changePassword.php");
          exit();
     }

     if (!pwdMatch($pwd, $pwdRe) == false) {
          $_SESSION['error'] = 'pwdMatch';
          header("Location: /Edumo/changePassword.php");
          exit();
     }

     updatePwd($conn, $pwd, $idUsers);

} else {
     $_SESSION['error'] = 'noaccess';
     header("Location: /Edumo/changePassword.php");
     exit();
}
