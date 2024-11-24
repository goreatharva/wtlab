<?php
session_start();

// Check if session or cookie exists
if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit;
}

// Use cookie data if session is not active
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
}

echo "Welcome, " . $_SESSION['username'] . "!<br>";
echo "<a href='logout.php'>Logout</a>";
?>
