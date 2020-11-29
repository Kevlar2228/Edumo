<?php

require 'header.php';
require 'includes/db.inc.php';

$idUsers = $_SESSION['idUsers'];
$uidUsers = $_SESSION['uidUsers'];
$userType = $_SESSION['typeSet'];
$idClass = $_SESSION['idClass'];

?>

<h3>Assignments: </h3>

<?php

if ($userType == "teacher") {
     echo '<a href="createAssignment.php">Create a new assignment</a>';
}

$sql = "SELECT * FROM assignments WHERE idClasses=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
     $_SESSION['error'] = 'sqlerror1';
     header('Location: /Edumo/assignments.php');
     exit();
}
mysqli_stmt_bind_param($stmt, "s", $idClass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while($row = mysqli_fetch_array($result)) {

     $idAssignment = $row['idAssignment'];
     $name = $row['nameAssignment'];
     $desc = $row['descAssignment'];
     $percent = $row['percentAssignment'];

     echo '
      <a href="assignment.php?idAssignment='.$idAssignment.'"><h3>'.$name.'</h3></a>
      <p>'.$desc.'</p>
      <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: '.$percent.'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <hr>
     ';


}

?>




<?php require 'footer.php'; ?>
