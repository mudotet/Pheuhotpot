<?php
session_start();
session_destroy(); // Destroy the session
header('Location: dang_nhap.php'); // Redirect to the login page
exit();
?>
