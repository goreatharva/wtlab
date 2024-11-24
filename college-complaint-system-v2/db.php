<?php
$host = 'localhost';
$dbname = 'college_complaints_v2'; // Update to your new database name
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>