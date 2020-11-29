<?php

if (isset($_POST['createClassSubmit'])) {

     session_start();

     $name = $_POST['name'];
     $desc = $_POST['desc'];
     $semester = $_POST['semester'];
     $idUsers = $_SESSION['idUsers'];

     require 'db.inc.php';
     require 'functions.inc.php';

     if (emptyInputClass($name, $desc, $semester) !== false) {
          $_SESSION['error'] = "emptyfields";
          header('Location: /Edumo/createClass.php');
          exit();
     }

     createClass($conn, $name, $desc, $semester, $idUsers);

} else {
     $_SESSION['error'] = "noaccess";
     header('Location: /Edumo/createClass.php');
     exit();
}
