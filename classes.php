<?php
require 'header.php';
require 'includes/db.inc.php';
$idUsers = $_SESSION['idUsers'];
$userType = $_SESSION['typeSet'];
unset($_SESSION['idClass']);

?>


<h1 class="mt-4">Your Classes</h1>

<a href="createClass.php">Create a new Class</a>
       <?php

       if ($userType == "teacher") {
            $sql = "SELECT * FROM classes WHERE ownerClasses=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                 $_SESSION['error'] = 'sqlerror1';
                 header('Location: /Edumo/classes.php');
                 exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $idUsers);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_assoc($result)) {

                 $idClasses = $row['idClasses'];
                 $name = $row['nameClasses'];
                 $desc = $row['descClasses'];
                 $semester = $row['semesterClasses'];

                 echo '
                  <a href="class.php?idClass='.$idClasses.'"><h3>'.$name.'</h3></a>
                  <p>'.$desc.'</p>
                  <p>'.$semester.'</p>
                  <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <hr>
                 ';


            }
       }
       else if($userType == "student") {
            $sql = "SELECT * FROM users WHERE idUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                 $_SESSION['error'] = 'sqlerror1';
                 header('Location: /Edumo/classes.php');
                 exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $idUsers);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            $classes = explode(",", $row['classMember']);

            $classesCount = count($classes);

            for ($x = 0; $x <= $classesCount-1; $x++) {
                 $sql = "SELECT * FROM classes WHERE idClasses=?;";
                 $stmt = mysqli_stmt_init($conn);
                 if (!mysqli_stmt_prepare($stmt, $sql)) {
                      $_SESSION['error'] = 'sqlerror1';
                      header('Location: /Edumo/classes.php');
                      exit();
                 }
                 mysqli_stmt_bind_param($stmt, "s", $classes[$x]);
                 mysqli_stmt_execute($stmt);
                 $result = mysqli_stmt_get_result($stmt);
                 $row2 = mysqli_fetch_assoc($result);

                 $idClasses = $row2['idClasses'];
                 $name = $row2['nameClasses'];
                 $desc = $row2['descClasses'];
                 $semester = $row2['semesterClasses'];

                 echo '
                  <a href="class.php?idClass='.$idClasses.'"><h3>'.$name.'</h3></a>
                  <p>'.$desc.'</p>
                  <p>'.$semester.'</p>
                  <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <hr>
                 ';
            }

       }

       ?>




<?php require 'footer.php'; ?>
