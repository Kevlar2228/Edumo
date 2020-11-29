<?php

require 'header.php';

?>

<h2>Signup</h2>

<form action="includes/signup.inc.php" method="post">
     <input type="text" name="uid" placeholder="Username">
     <input type="email" name="email" placeholder="E-Mail">
     <input type="password" name="pwd" placeholder="Password">
     <input type="password" name="pwdRe" placeholder="Re-Enter Password">
     <input type="submit" name="signupSubmit" value="Signup">
</form>

<?php

require 'footer.php';

?>
