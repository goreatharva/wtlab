<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];

    foreach ($_POST['attendance'] as $student_id => $status) {
        $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $student_id, $date, $status);
        $stmt->execute();
    }

    echo "Attendance recorded successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mark Attendance</title>
</head>
<body>
    <form method="POST" action="">
        <label>Date:</label>
        <input type="date" name="date" required><br><br>
        <table border="1">
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM students");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['roll_no']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>
                            <input type='radio' name='attendance[{$row['id']}]' value='Present' required> Present
                            <input type='radio' name='attendance[{$row['id']}]' value='Absent' required> Absent
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <button type="submit">Submit Attendance</button>
    </form>
</body>
</html>
