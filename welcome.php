<?php

require 'header.php';

?>

<h1>Welcome to EduNow</h1>

Choose the type for this Account:

<form action="includes/accountType.inc.php" method="post">
     <input type="radio" name="type" value="student">
     <label for="student">Student</label>
     <br>
     <input type="radio" name="type" value="teacher">
     <label for="student">Teacher</label>
     <br>
     <input type="submit" name="typeSubmit" value="Submit">
</form>
