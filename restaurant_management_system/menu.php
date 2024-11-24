<?php 
session_start(); 
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

// Fetch menu items from the database
$stmt = $pdo->query("SELECT * FROM menu");
$menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
<div class="container">
        <h1>Menu</h1>

        <?php foreach ($menu_items as $item): ?>
            <div class="menu-item">
                <h2><?php echo htmlspecialchars($item['item_name']); ?></h2>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <p>Price: ₹<?php echo htmlspecialchars($item['price']); ?></p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="menu_item_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                    <input type="number" name="quantity" min="1" value="1" required />
                    <button type="submit">Order Now</button>
                </form>
            </div>
        <?php endforeach; ?>
        
        <a href="logout.php">Logout</a> <!-- Logout option -->
</div>

<style>
.menu-item {
   border: 1px solid #ccc;
   padding: 15px;
   margin-bottom: 10px;
}
</style>

</body>
</html>
