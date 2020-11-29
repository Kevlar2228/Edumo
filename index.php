<?php require 'header.php';

if (isset($_SESSION['idUsers'])) {
     require 'loggedin.php';
} else {
     require 'loggedout.php';
}
?>



<?php require 'footer.php'; ?>
