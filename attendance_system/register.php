<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll_no = intval($_POST['roll_no']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO students (roll_no, name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $roll_no, $name, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
</head>
<body>
    <form method="POST" action="">
        <label>Roll No:</label>
        <input type="number" name="roll_no" required><br>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
