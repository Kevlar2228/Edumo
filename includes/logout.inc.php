<?php

session_start();
session_unset();
session_destroy();

$_SESSION['error'] = 'none';
header('Location: /Edumo/index.php');
exit();
