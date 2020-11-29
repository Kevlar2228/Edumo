<?php
session_start();
if (isset($_SESSION['idUsers'])) {
     $idUsers = $_SESSION['idUsers'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title></title>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

     </head>
     <body>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/Edumo/index.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/Edumo/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <?php

                       if (isset($_SESSION['idUsers'])) {
                            echo '<a class="dropdown-item" href="/Edumo/profile.php?idUsers='.$idUsers.'">Profile</a>';
                            echo '<a class="dropdown-item" href="/Edumo/includes/logout.inc.php">Logout</a>';
                       } else {
                            echo '
                            <a class="dropdown-item" href="/Edumo/login.php">Login</a>
                            <a class="dropdown-item" href="/Edumo/signup.php">Signup</a>
                            ';
                       }

                       ?>
                </li>
              </ul>
            </div>
          </nav>

<?php


if (isset($_SESSION['error'])) {
     if ($_SESSION['error'] == 'noaccess') {
          echo "
          <div class='ml-4 mr-4 alert alert-danger' role='alert'>
               You have no access to that page
          </div>";
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'emptyfields') {
          echo "
          <div class='alert alert-danger' role='alert'>
               You can't leave any fields empty
          </div>";
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'invalidUid') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Invalid Username
          </div>";
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'invalidEmail') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Invalid Email
          </div>";
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'pwdMatch') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Passwords doesn't match
          </div>";
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'uidExists') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Username already taken
          </div>";
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'sqlerror1') {
          echo "
          <div class='alert alert-danger' role='alert'>
               SQLerror 1
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'sqlerror2') {
          echo "
          <div class='alert alert-danger' role='alert'>
               SQLerror 2
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'none') {
          echo "
          <div class='alert alert-success' role='alert'>
               Success!
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'wronglogin1') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Wrong Login Details 1
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'wronglogin2') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Wrong Login Details 2
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'useralreadymember') {
          echo "
          <div class='alert alert-danger' role='alert'>
               User Already Member
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'emptyfolder') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Empty Folder
          </div>".error_get_last();
          unset($_SESSION['error']);
     }

     else if ($_SESSION['error'] == 'pwdCheck') {
          echo "
          <div class='alert alert-danger' role='alert'>
               Check Password
          </div>".error_get_last();
          unset($_SESSION['error']);
     }
}

?>
