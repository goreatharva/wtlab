<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $item_id = $_POST['item_id'];
            $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = ?");
            $stmt->execute([$item_id]);
            $item = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($item) {
                echo "<h1>Order Confirmation</h1>";
                echo "<h2>Item: " . htmlspecialchars($item['name']) . "</h2>";
                echo "<p>Description: " . htmlspecialchars($item['description']) . "</p>";
                echo "<p>Price: $" . htmlspecialchars($item['price']) . "</p>";
                echo "<p>Thank you for your order!</p>";
            } else {
                echo "<p>Item not found.</p>";
            }
        } else {
            echo "<p>No order submitted.</p>";
        }
        ?>
        <a href="index.php">Back to Menu</a>
    </div>
</body>
</html>