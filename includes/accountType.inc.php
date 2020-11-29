<?php

if (isset($_POST['typeSubmit'])) {

     session_start();

     require 'db.inc.php';

     $idUsers = $_SESSION['idUsers'];

     $type = $_POST['type'];

     if ($type == 'student') {
          $sql = "UPDATE users SET typeSet='student' WHERE idUsers=$idUsers;";
          $sth = $conn->query($sql);

          if (!$sth) {
               $_SESSION['error'] = "sqlerror1";
               header('Location: /Edumo/welcome.php');
               exit();
          }
          else {
               $_SESSION['typeSet'] = 'student';
               $_SESSION['error'] = "none";
               header('Location: /Edumo/index.php');
               exit();
          }
     }

     else if ($type == 'teacher') {
          $sql = "UPDATE users SET typeSet='teacher' WHERE idUsers=$idUsers;";
          $sth = $conn->query($sql);

          if (!$sth) {
               $_SESSION['error'] = "sqlerror1";
               header('Location: /Edumo/welcome.php');
               exit();
          }
          else {
               $_SESSION['typeSet'] = 'teacher';
               $_SESSION['error'] = "none";
               header('Location: /Edumo/index.php');
               exit();
          }
     }


} else {
     $_SESSION['error'] = "noaccess";
     header('Location: /Edumo/signup.php');
     exit();
}
