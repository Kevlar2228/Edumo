<?php

$idAssignment = $_GET['idAssignment'];

if (isset($_POST['changeAssignmentSubmit'])) {

     session_start();

     require 'db.inc.php';

     $name = $_POST['name'];
     $desc = $_POST['desc'];
     $percent = $_POST['percent'];

     if (empty($name) || empty($desc) || empty($percent)) {
          $_SESSION['error'] = 'emptyfields';
          header("Location: /Edumo/changeAssignment.php?idAssignment=$idAssignment");
          exit();
     }

     $sql = "UPDATE assignments SET nameAssignment=?, descAssignment=?, percentAssignment=? WHERE idAssignment=?";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          header("Location: /Edumo/changeAssignment.php?idAssignment=$idAssignment");
          exit();
     }
     mysqli_stmt_bind_param($stmt, "ssss", $name, $desc, $percent, $idAssignment);
     mysqli_stmt_execute($stmt);

     $_SESSION['error'] = 'none';
     header("Location: /Edumo/assignment.php?idAssignment=$idAssignment");
     exit();

} else {
     $_SESSION['error'] = 'noaccess';
     header("Location: /Edumo/changeAssignment.php?idAssignment=$idAssignment");
     exit();
}
