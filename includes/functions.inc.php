<?php

function error($msg, $dir) {
     session_start();
     $_SESSION['error'] = $msg;
     header("Location: /Edumo/$dir");
     exit();
}

function emptyInputSignup($uid, $email, $pwd, $pwdRe) {
     $result;
     if (empty($uid) || empty($email) || empty($email) || empty($pwd) || empty($pwdRe)) {
          $result = true;
     } else {
          $result = false;
     }
     return $result;
}

function invalidUid($uid) {
     $result;
     if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
          $result = D;
     } else {
          $result = false;
     }
     return $result;
}

function invalidEmail($email) {
     $result;
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $result = true;
     } else {
          $result = false;
     }
     return $result;
}

function pwdMatch($pwd, $pwdRe) {
     $result;
     if ($pwd !== $pwdRe) {
          $result = true;
     } else {
          $result = false;
     }
     return $result;
}

function uidExists($conn, $uid, $email) {

     $sql = "SELECT * FROM users WHERE uidUsers = ? OR emailUsers = ?;";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          echo $stmt->error;
          header('Location: /Edumo/signup.php');
          exit();
     }

     mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
     mysqli_stmt_execute($stmt);

     $resultData = mysqli_stmt_get_result($stmt);

     if ($row = mysqli_fetch_assoc($resultData)) {
          return $row;
     } else {
          $result = false;
          return $result;
     }

     mysqli_stmt_close($stmt);
}

function createUser($conn, $uid, $email, $pwd) {

     $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?);";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror2';
          echo $stmt->error;
          header('Location: /Edumo/signup.php');
          exit();
     }

     $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

     mysqli_stmt_bind_param($stmt, "sss", $uid, $email, $hashedPwd);
     if (mysqli_stmt_execute($stmt)) {
          $_SESSION['error'] = 'none';
          mysqli_stmt_close($stmt);
          header('Location: /Edumo/index.php');
          exit();
     } else {
          echo $stmt->error;
     }





}

function emptyInputLogin($uidEmail, $pwd) {
     $result;
     if (empty($uidEmail) || empty($pwd)) {
          $result = true;
     } else {
          $result = false;
     }
     return $result;
}

function LoginUser($conn, $uidEmail, $pwd) {
     $uidExists = uidExists($conn, $uidEmail, $uidEmail);

     if ($uidExists === false) {
          $_SESSION['error'] = 'wronglogin1';
          header('Location: /Edumo/login.php');
          exit();
     }


     $pwdHashed = $uidExists['pwdUsers'];
     $checkPwd = password_verify($pwd, $pwdHashed);

     if ($checkPwd === false) {

          $_SESSION['error'] = 'wronglogin2';
          header('Location: /Edumo/login.php');
          exit();
     }
     else if ($checkPwd === true) {

          $_SESSION['idUsers'] = $uidExists['idUsers'];
          $_SESSION['uidUsers'] = $uidExists['uidUsers'];
          $_SESSION['typeSet'] = $uidExists['typeSet'];
          $_SESSION['error'] = 'none';
          $id = $uidExists['idUsers'];

               if (empty($uidExists['typeSet'])) {
                    header('Location: /Edumo/welcome.php');
                    exit();
               } else {
                    header('Location: /Edumo/index.php');
                    exit();
               }

     }
}

function emptyInputClass($name, $desc, $semester) {
     $result;
     if (empty($name) || empty($desc) || empty($semester)) {
          $result = true;
     } else {
          $result = false;
     }
     return $result;
}

function createClass($conn, $name, $desc, $semester, $idUsers) {

     $sql = "INSERT INTO classes (nameClasses, descClasses, semesterClasses, ownerClasses, memberClasses) VALUES (?, ?, ?, ?, ?);";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          echo $stmt->error;
          // header('Location: /Edumo/createClass.php');
          exit();
     }
     mysqli_stmt_bind_param($stmt, 'sssss', $name, $desc, $semester, $idUsers, $idUsers);
     if (!mysqli_stmt_execute($stmt)) {
          $_SESSION['error'] = 'sqlerror1';
          echo $stmt->error;
          // header('Location: /Edumo/createClass.php');
          exit();
     }

     $_SESSION['error'] = 'none';
     header('Location: /Edumo/classes.php');
     exit();

}

function getData($conn, $dbase, $idType, $id) {
     $sql = "SELECT * FROM $dbase WHERE $idType=?;";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          echo $stmt->error;
          // header('Location: /Edumo/createClass.php');
          exit();
     }
     mysqli_stmt_bind_param($stmt, "s", $id);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

     $row = mysqli_fetch_assoc($result);

     return($row);
}

function emptyPwdChange($pwdLast, $pwd, $pwdRe) {
     if (empty($pwdLast) || empty($pwd) || empty($pwdRe)) {
          return true;
     } else {
          return false;
     }
}

function pwdCheck($pwdLast, $pwd) {
     $checkPwd = password_verify($pwdLast, $pwd);

     if ($checkPwd === false) {
          return false;
     }
     else if ($checkPwd === true) {
          return true;
     }
}

function updatePwd($conn, $pwd, $idUsers) {

     $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

     $sql = "UPDATE users SET pwdUsers=? WHERE idUsers=?;";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          header("Location: /Edumo/changePassword.php");
          exit();
     }

     mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $idUsers);
     if (mysqli_stmt_execute($stmt)) {
          $_SESSION['error'] = 'none';
          header("Location: /Edumo/changePassword.php");
          exit();
     }

}
