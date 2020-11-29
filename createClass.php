<?php require 'header.php'; ?>

<h2 class="mt-4">Create a new Class</h2>

<form class="mt-4" action="includes/createClass.inc.php" method="post">
     <input type="text" name="name" placeholder="Name">
     <input type="text" name="desc" placeholder="Description">
     <input type="text" name="semester" placeholder="Semester">
     <input type="submit" name="createClassSubmit" value="Create Class">
</form>
