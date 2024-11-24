<?php 
session_start(); 
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
   header("Location: login.php"); // Redirect if not logged in
   exit();
}

// Check if the logged-in user is an admin (optional)
$stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user['role'] !== 'admin') {
   header("Location: menu.php"); // Redirect to menu if not admin
   exit();
}

// Fetch all orders from the database (for admin view)
$order_stmt = $pdo->query("SELECT orders.id AS order_id, users.username AS customer_username, menu.item_name AS ordered_item, orders.quantity AS ordered_quantity FROM orders JOIN users ON orders.user_id = users.id JOIN menu ON orders.menu_item_id = menu.id");
$orders = $order_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>
</head>
<body>

<div class="container">
   <h1>Admin Dashboard</h1>

   <!-- Display all orders -->
   <h2>All Orders:</h2>

   <?php if (!empty($orders)): ?>
       <table border='1'>
           <tr><th>Order ID</th><th>Customer Username</th><th>Ordered Item</th><th>Quantity</th></tr>

           <?php foreach ($orders as $order): ?>
               <tr>
                   <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                   <td><?php echo htmlspecialchars($order['customer_username']); ?></td>
                   <td><?php echo htmlspecialchars($order['ordered_item']); ?></td>
                   <td><?php echo htmlspecialchars($order['ordered_quantity']); ?></td>
               </tr>
           <?php endforeach; ?>

       </table>

   <?php else: ?>
       <p>No orders found.</p>
   <?php endif; ?>

   <!-- Logout option -->
   <a href="logout.php">Logout</a>

</div>

<style>
.container { width: 50%; margin: auto; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
h2 { margin-top: 20px; }
</style>

</body>
</html>
