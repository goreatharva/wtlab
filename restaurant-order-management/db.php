<?php
$host = 'localhost';
$dbname = 'restaurant_orders';
$username = 'root'; // Default username for XAMPP/MAMP
$password = ''; // Default password for XAMPP/MAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>