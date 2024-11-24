<?php 
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    
    if ($stmt->execute([$username, $password])) {
        echo "<p>User registered successfully!</p>";
    } else {
        echo "<p>Error registering user.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login here</a>
    </div>
</body>
</html>