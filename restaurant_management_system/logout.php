<?php 
session_start(); 
include 'db.php'; 

if (isset($_SESSION['user_id'])) {
   // Remove session from database for this session ID.
   session_unset();
   session_destroy();
}

header("Location: login.php"); // Redirect to login page after logout.
exit();
?>