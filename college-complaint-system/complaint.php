<?php 
session_start(); 
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Complaint</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register Complaint</h1>
        <form action="" method="POST">
            <textarea name="complaint_text" placeholder="Describe your complaint..." required></textarea>
            <button type="submit">Submit Complaint</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $studentId = $_SESSION['user_id']; // Get user ID from session
            $complaintText = $_POST['complaint_text'];

            // Insert complaint into database
            $stmt = $pdo->prepare("INSERT INTO complaints (student_id, complaint_text) VALUES (?, ?)");
            if ($stmt->execute([$studentId, $complaintText])) {
                echo "<p>Complaint submitted successfully!</p>";
            } else {
                echo "<p>Error submitting complaint.</p>";
            }
        }
        ?>
    </div>
</body>
</html>