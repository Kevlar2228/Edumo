<?php

require 'header.php';
require 'includes/db.inc.php';

$idUsers = $_SESSION['idUsers'];
$uidUsers = $_SESSION['uidUsers'];
$userType = $_SESSION['typeSet'];

?>

<h2>Create a new assignment</h2>

<form action="includes/createAssignment.inc.php" method="post">
     <input type="text" name="name" placeholder="Name">
     <input type="text" name="desc" placeholder="Description">
     <input type="number" name="percent" placeholder="Percent" min="1" max="100">
     <input type="submit" name="createAssignmentSubmit" value="Create Assignment">
</form>

<?php require 'footer.php'; ?>
