<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>All Complaints</h1>

        <?php
        // Fetch all complaints from the database
        $stmt = $pdo->query("SELECT complaints.id, users.username, complaints.complaint_text, complaints.date FROM complaints JOIN users ON complaints.student_id = users.id");
        
        echo "<table border='1'>
                <tr><th>ID</th><th>Student Username</th><th>Complaint Text</th><th>Date</th></tr>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['complaint_text']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        ?>
        
        <a href="admin_login.php">Logout</a> <!-- Link back to admin login -->
    </div>
</body>
</html>