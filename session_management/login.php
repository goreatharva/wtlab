<?php
session_start();
require 'db.php';

// Simulated login for demonstration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id']); // Take user ID from form
    $_SESSION['user_id'] = $userId; // Store user ID in session
    header("Location: dashboard.php"); // Redirect to the dashboard
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <label for="user_id">Enter User ID:</label>
        <input type="number" id="user_id" name="user_id" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
