<?php

$idClass = $_GET['idClass'];

if (isset($_POST['changeClassSubmit'])) {

     session_start();

     require 'db.inc.php';

     $name = $_POST['name'];
     $desc = $_POST['desc'];
     $semester = $_POST['semester'];

     if (empty($name) || empty($desc) || empty($semester)) {
          $_SESSION['error'] = 'emptyfields';
          header("Location: /Edumo/changeClass.php?idClass=$idClass");
          exit();
     }

     $sql = "UPDATE classes SET nameClasses=?, descClasses=?, semesterClasses=? WHERE idClasses=?";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
          $_SESSION['error'] = 'sqlerror1';
          header("Location: /Edumo/changeClass.php?idClass=$idClass");
          exit();
     }
     mysqli_stmt_bind_param($stmt, "ssss", $name, $desc, $semester, $idClass);
     mysqli_stmt_execute($stmt);

     $_SESSION['error'] = 'none';
     header("Location: /Edumo/class.php?idClass=$idClass");
     exit();

} else {
     $_SESSION['error'] = 'noaccess';
     header("Location: /Edumo/changeClass.php?idClass=$idClass");
     exit();
}
