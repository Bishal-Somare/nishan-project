<?php
session_start();  // Start the session

// Destroy the session to log out the user
session_destroy();

// Redirect the user to the login page
header("Location: login_staff.html");  // Change this to the appropriate login page if needed
exit;
?>
