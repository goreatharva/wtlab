<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Set cookies
            setcookie("user_id", $user['id'], time() + (86400 * 7), "/"); // 7 days
            setcookie("username", $user['username'], time() + (86400 * 7), "/"); // 7 days

            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "No user found with this email!";
    }

    $stmt->close();
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
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
