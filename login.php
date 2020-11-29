<?php

require 'header.php';

?>

<h2>Login</h2>

<form action="includes/login.inc.php" method="post">
     <input type="text" name="uidemail" placeholder="Username">
     <input type="password" name="pwd" placeholder="Password">
     <input type="submit" name="loginSubmit" value="Login">
</form>
<a href="forgotPassword.php">Forgot your Password?</a>

<?php

require 'footer.php';

?>
