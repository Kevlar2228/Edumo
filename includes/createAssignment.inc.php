<?php

if (isset($_POST['createAssignmentSubmit'])) {
     session_start();
     require 'db.inc.php';

     $idClass = $_SESSION['idClass'];
     $name = $_POST['name'];
     $desc = $_POST['desc'];
     $percent = $_POST['percent'];

     if (empty($name) || empty($desc) || empty($percent)) {
          $_SESSION['error'] = "emptyfields";
          header('Location: /Edumo/createAssignment.php');
          exit();
     }

     $sql = "INSERT INTO assignments (nameAssignment, descAssignment, percentAssignment, idClasses) VALUES (?, ?, ?, ?)";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          header('Location: /Edumo/createAssignment');
          exit();
     }

     mysqli_stmt_bind_param($stmt, "ssss", $name, $desc, $percent, $idClass);
     mysqli_stmt_execute($stmt);

     $_SESSION['error'] = 'none';
     header('Location: /Edumo/assignments.php');
     exit();

} else {
     $_SESSION['error'] = "noaccess";
     header('Location: /Edumo/createAssignment.php');
     exit();
}
