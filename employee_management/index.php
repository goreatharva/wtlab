<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (usually empty)
$dbname = "employee_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert employee record if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO employees (name, position, salary) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $position, $salary);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>New employee added successfully</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Fetch all employees
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { color: #333; }
        h2 { color: #555; }
        form { margin-bottom: 20px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; margin: 5px 0; }
        input[type="submit"] { background-color: #4CAF50; color: white; border: none; padding: 10px 15px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Employee Management System</h1>

    <h2>Add Employee</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        Position: <input type="text" name="position" required><br>
        Salary: <input type="number" name="salary" required step="0.01"><br>
        <input type="submit" value="Add Employee">
    </form>

    <h2>Employee List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["id"]) . "</td><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["position"]) . "</td><td>" . htmlspecialchars($row["salary"]) . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>