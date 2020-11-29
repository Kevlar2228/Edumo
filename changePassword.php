<?php
require 'header.php';
require 'includes/db.inc.php';
require 'includes/functions.inc.php';
$idUsers = $_SESSION['idUsers'];
$userType = $_SESSION['typeSet'];

?>

<form action="includes/changePassword.inc.php" method="post">
     <input type="password" name="pwdLast" placeholder="Current Password">
     <input type="password" name="pwd" placeholder="New Password">
     <input type="password" name="pwdRe" placeholder="Re-Enter New Password">
     <input type="submit" name="changeAssignmentSubmit" value="Submit">
</form>

<?php require 'footer.php'; ?>
