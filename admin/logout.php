<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page with a logout message
header("Location: ../index.php?pesan=logout");
exit();
?>
