<?php

require 'header.php';
require 'includes/db.inc.php';

$idUsers = $_SESSION['idUsers'];
$uidUsers = $_SESSION['uidUsers'];
$userType = $_SESSION['typeSet'];
$idClass = $_SESSION['idClass'];



$idAssignment = $_GET['idAssignment'];

$sql = "SELECT * FROM assignments WHERE idAssignment=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
     $_SESSION['error'] = 'sqlerror1';
     header("Location: /Edumo/assignment.php?idAssignment=$idAssignment");
     exit();
}
mysqli_stmt_bind_param($stmt, "s", $idAssignment);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

$name = $row['nameAssignment'];
$desc = $row['descAssignment'];
$percent = $row['percentAssignment'];

echo '
<a href="assignment.php?idAssignment='.$idAssignment.'"><h3>'.$name.'</h3></a>
<p>'.$desc.'</p>
<div class="progress">
     <div class="progress-bar" role="progressbar" style="width: '.$percent.'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
';

if ($userType == "teacher") {
     echo '<a href="changeAssignment.php?idAssignment='.$idAssignment.'">Change Assignment</a>';
} else {
     echo '
     <a href="uploadAssignmentFolder.php?idAssignment=<?= $idAssignment ?>">Upload Folder</a>
     <br>
     <a href="uploadAssignmentFile.php?idAssignment=<?= $idAssignment ?>">Upload File</a>
     ';
}

?>
