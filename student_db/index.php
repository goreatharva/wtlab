<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Student Registration Form</h2>
    <form action="process_registration.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="year_of_study">Year of Study:</label>
        <select id="year_of_study" name="year_of_study" required>
            <option value="1">First Year</option>
            <option value="2">Second Year</option>
            <option value="3">Third Year</option>
            <option value="4">Final Year</option>
        </select><br><br>

        <div id="semesters">
            <label for="semester_1_sgpa">Semester 1 SGPA:</label>
            <input type="text" id="semester_1_sgpa" name="semester_1_sgpa" required><br><br>

            <label for="semester_2_sgpa">Semester 2 SGPA:</label>
            <input type="text" id="semester_2_sgpa" name="semester_2_sgpa" required><br><br>
        </div>

        <input type="submit" value="Submit">
    </form>

    <script>
        document.getElementById('year_of_study').addEventListener('change', function() {
            const year = this.value;
            let semesterFields = '';

            if (year >= 2) {
                semesterFields += '<label for="semester_3_sgpa">Semester 3 SGPA:</label><input type="text" id="semester_3_sgpa" name="semester_3_sgpa"><br><br>';
                semesterFields += '<label for="semester_4_sgpa">Semester 4 SGPA:</label><input type="text" id="semester_4_sgpa" name="semester_4_sgpa"><br><br>';
            }

            if (year >= 3) {
                semesterFields += '<label for="semester_5_sgpa">Semester 5 SGPA:</label><input type="text" id="semester_5_sgpa" name="semester_5_sgpa"><br><br>';
                semesterFields += '<label for="semester_6_sgpa">Semester 6 SGPA:</label><input type="text" id="semester_6_sgpa" name="semester_6_sgpa"><br><br>';
            }

            if (year == 4) {
                semesterFields += '<label for="semester_7_sgpa">Semester 7 SGPA:</label><input type="text" id="semester_7_sgpa" name="semester_7_sgpa"><br><br>';
                semesterFields += '<label for="semester_8_sgpa">Semester 8 SGPA:</label><input type="text" id="semester_8_sgpa" name="semester_8_sgpa"><br><br>';
            }

            document.getElementById('semesters').innerHTML = semesterFields;
        });
    </script>
</body>
</html>
