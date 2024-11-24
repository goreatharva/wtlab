<?php 
session_start(); 
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

// Handle order form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $menuItemId = $_POST['menu_item_id'];
    $quantity = $_POST['quantity'];

    // Insert order into the database
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, menu_item_id, quantity) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$userId, $menuItemId, $quantity])) {
        echo "<p>Order placed successfully!</p>";
        echo '<a href="menu.php">Back to Menu</a>';
        
        // Optionally display all orders or redirect back to the menu.
        
        // You can fetch and display all orders placed by this user here.
        
        exit();
        
      } else {
          echo "<p>Error placing order.</p>";
      }
}
?>