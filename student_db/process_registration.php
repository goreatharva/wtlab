<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username
$password = ""; // Default password is empty
$dbname = "student_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO students (year_of_study, sgpa_sem1, sgpa_sem2, sgpa_sem3, sgpa_sem4, sgpa_sem5, sgpa_sem6, sgpa_sem7, sgpa_sem8) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssss", $year_of_study, $sgpa_sem1, $sgpa_sem2, $sgpa_sem3, $sgpa_sem4, $sgpa_sem5, $sgpa_sem6, $sgpa_sem7, $sgpa_sem8);

// Set parameters and execute
$year_of_study = $_POST['yearOfStudy'];
$sgpa_sem1 = $_POST['sgpa_sem1'] ?? null;
$sgpa_sem2 = $_POST['sgpa_sem2'] ?? null;
$sgpa_sem3 = $_POST['sgpa_sem3'] ?? null;
$sgpa_sem4 = $_POST['sgpa_sem4'] ?? null;
$sgpa_sem5 = $_POST['sgpa_sem5'] ?? null;
$sgpa_sem6 = $_POST['sgpa_sem6'] ?? null;
$sgpa_sem7 = $_POST['sgpa_sem7'] ?? null;
$sgpa_sem8 = $_POST['sgpa_sem8'] ?? null;

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>
