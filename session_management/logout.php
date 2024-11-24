<?php 
session_start(); 
include 'db.php'; 

if (isset($_SESSION['user_id'])) {
    // Remove session from database
    $stmt = $pdo->prepare("DELETE FROM sessions WHERE session_id = ?");
    $stmt->execute([session_id()]);

    // Destroy the session
    session_unset();
    session_destroy();
}

header("Location: login.php"); // Redirect to login page after logout
exit();
?>