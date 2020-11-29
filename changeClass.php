<?php

require 'header.php';
require 'includes/db.inc.php';

$idClass = $_GET['idClass'];
$_SESSION['idClass'] = $idClass;
$userType = $_SESSION['typeSet'];
$idUsers = $_SESSION['idUsers'];

$sql = "SELECT * FROM classes WHERE idClasses=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
     $_SESSION['error'] = 'sqlerror1';
     header('Location: /Edumo/class.php?idClasses='.$idClass);
     exit();
}

mysqli_stmt_bind_param($stmt, "s", $idClass);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

$name = $row['nameClasses'];
$desc = $row['descClasses'];
$semester = $row['semesterClasses'];
$owner = $row['ownerClasses'];

echo '
<h2>Change Class</h2>
<form action="includes/changeClass.inc.php?idClass='.$idClass.'" method="post">
     <input type="text" name="name" value="'.$name.'">
     <input type="text" name="desc" value="'.$desc.'">
     <input type="text" name="semester" value="'.$semester.'">
     <input type="submit" name="changeClassSubmit" value="Create Class">
</form>

';

?>
<?php require 'footer.php'; ?>
