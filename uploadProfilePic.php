<?php
require 'header.php';
require 'includes/db.inc.php';
require 'includes/functions.inc.php';
$idUsers = $_SESSION['idUsers'];
$userType = $_SESSION['typeSet'];
?>

<form action="includes/uploadProfilePic.inc.php" method="post" enctype="multipart/form-data">
     <label for="upload">File to Upload:</label>
     <input type="file" name="upload" value=""><br>
     <input type="submit" name="uploadProfilePicSubmit" value="Upload">
</form>

<?php require 'footer.php'; ?>
