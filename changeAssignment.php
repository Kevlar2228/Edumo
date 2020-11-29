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
}
mysqli_stmt_bind_param($stmt, "s", $idAssignment);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name = $row['nameAssignment'];
$desc = $row['descAssignment'];
$percent = $row['percentAssignment'];

?>

<h2>Change a new assignment</h2>

<?php

echo '
<form action="includes/changeAssignment.inc.php?idAssignment='.$idAssignment.'" method="post">
     <input type="text" name="name" value="'.$name.'">
     <input type="text" name="desc" value="'.$desc.'">
     <input type="number" name="percent" value="'.$percent.'" min="1" max="100">
     <input type="submit" name="changeAssignmentSubmit" value="Create Assignment">
</form>

';

?>
<?php require 'footer.php'; ?>
