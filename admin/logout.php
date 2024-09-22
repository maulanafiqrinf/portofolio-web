<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page with a logout message
header("Location: ../login.php?pesan=logout");
exit();
?>
