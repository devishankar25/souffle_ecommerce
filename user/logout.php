<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the main page
header("Location: ./main_page.php"); // Ensure the path is relative to the current file
exit();
