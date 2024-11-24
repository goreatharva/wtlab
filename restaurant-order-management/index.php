<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Order Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Restaurant Menu</h1>
        <div class="menu">
            <?php
            $stmt = $pdo->query("SELECT * FROM menu_items");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='menu-item'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                echo "<form action='order.php' method='POST'>";
                echo "<input type='hidden' name='item_id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Order Now'>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>