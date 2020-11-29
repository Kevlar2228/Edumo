<?php

if (!empty($_GET['id'])) {
     session_start();

     $currentUser = $_SESSION['idUsers'];

     $idUsers = $_GET['id'];
     $idClass = $_GET['idclass'];



     require 'db.inc.php';

     $sql = "SELECT * FROM classes WHERE idClasses=?";
     $stmt = mysqli_stmt_init($conn);

     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          header('Location: /Edumo/class.php?idClass='.$idClass);
          exit();
     }

     mysqli_stmt_bind_param($stmt, "s", $idClass);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

     $row = mysqli_fetch_assoc($result);

     if (empty($row['memberClasses'])) {
          $sql = "UPDATE classes SET memberClasses=? WHERE idClasses=?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
               $_SESSION['error'] = 'sqlerror1';
               header('Location: /Edumo/class.php?idClass='.$idClass);
               exit();
          }

          mysqli_stmt_bind_param($stmt, "ss", $idUsers, $idClass);

          if (mysqli_stmt_execute($stmt)) {
               $_SESSION['error'] = 'none';
               header('Location: /Edumo/class.php?idClass='.$idClass);
               exit();
          } else {
               $_SESSION['error'] = 'sqlerror2';
               header('Location: /Edumo/class.php?idClass='.$idClass);
               exit();
          }

     } else {

          $members = explode(',', $row['memberClasses']);

          $memberCount = count($members);

          for ($x = 0; $x <= $memberCount-1; $x++) {
               if ($members[$x] === $idUsers) {
                    $_SESSION['error'] = 'useralreadymember';
                    header('Location: /Edumo/class.php?idClass='.$idClass);
                    exit();
               }
               else if ($members[$x] === $currentUser) {
                    $_SESSION['error'] = 'useralreadymember';
                    header('Location: /Edumo/class.php?idClass='.$idClass);
                    exit();
               }
          }
          $sql = "UPDATE classes SET memberClasses=? WHERE idClasses=?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
               $_SESSION['error'] = 'sqlerror1';
               header('Location: /Edumo/class.php?idClass='.$idClass);
               exit();
          }

          $newMember = $row['memberClasses'].','.$idUsers;

          mysqli_stmt_bind_param($stmt, "ss", $newMember, $idClass);

          if (mysqli_stmt_execute($stmt)) {

               $sql = "SELECT * FROM users WHERE idUsers=?";
               $stmt = mysqli_stmt_init($conn);

               if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $_SESSION['error'] = 'sqlerror1';
                    header('Location: /Edumo/class.php?idClass='.$idClass);
                    exit();
               }

               mysqli_stmt_bind_param($stmt, "s", $idUsers);
               mysqli_stmt_execute($stmt);

               $result = mysqli_stmt_get_result($stmt);

               $row2 = mysqli_fetch_assoc($result);

               $sql = "UPDATE users SET classMember=? WHERE idUsers=?";
               $stmt = mysqli_stmt_init($conn);
               if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $_SESSION['error'] = 'sqlerror1';
                    header('Location: /Edumo/class.php?idClass='.$idClass);
                    exit();
               }

               $newMember = $row2['classMember'].','.$idClass;

               mysqli_stmt_bind_param($stmt, "ss", $newMember, $idUsers);

               if (mysqli_stmt_execute($stmt)) {

               $_SESSION['error'] = 'none';
               header('Location: /Edumo/class.php?idClass='.$idClass);
               exit();
          } else {
               $_SESSION['error'] = 'sqlerror2';
               header('Location: /Edumo/class.php?idClass='.$idClass);
               exit();
          }

     }}

} else {
     $_SESSION['error'] = 'noaccess';
     header('Location: /Edumo/class.php?idClass='.$idClass);
     exit();
}
