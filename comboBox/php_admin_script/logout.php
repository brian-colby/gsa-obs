<?php
// initialize the session
session_start();

//unset all session variables
$_SESSION = array();

//destroy the session
session_unset();
session_destroy();

//redirect to index page
header("location: ../index.php");
exit;
?>