<?php
require 'header.php';
require 'includes/db.inc.php';
require 'includes/functions.inc.php';
$idUsers = $_SESSION['idUsers'];
$userType = $_SESSION['typeSet'];

$user = getData($conn, 'users', 'idUsers', $idUsers);

echo '
     <img src="profilePics/'.$user['picUsers'].'" width="200px" />
     <h2>'.$user['uidUsers'].'</h2>
';

?>

<a href="uploadProfilePic.php">Upload a Profile Picture</a>
<br>
<a href="changePassword.php">Change Passwords</a>

<?php require 'footer.php'; ?>
