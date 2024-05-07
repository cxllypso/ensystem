<?php
include 'db_connect.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $subject_code = $_POST['subject_code'];
    $subject_name = $_POST['subject_name'];
    $lab_unit = $_POST['lab_unit'];
    $lec_unit = $_POST['lec_unit'];
    $description = $_POST['description'];
    $yearlevel = $_POST['yearlevel'];
    $AY = $_POST['AY'];

    // SQL query to insert subject data into the database
    $sql = "INSERT INTO subjects (subject_code, subject_name, lab_unit, lec_unit, description, yearlevel, AY) 
            VALUES ('$subject_code', '$subject_name', '$lab_unit', '$lec_unit', '$description', '$yearlevel', '$AY')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'img/crs.png';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #4CAF50;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="submit"],
        select {
            width: 50%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add Subject</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="subject_code">Subject Code:</label><br>
        <input type="text" id="subject_code" name="subject_code" required><br>

        <label for="subject_name">Subject Name:</label><br>
        <input type="text" id="subject_name" name="subject_name" required><br>

        <label for="lab_unit">Lab Unit:</label><br>
        <input type="number" id="lab_unit" name="lab_unit" required><br>

        <label for="lec_unit">Lec Unit:</label><br>
        <input type="number" id="lec_unit" name="lec_unit" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br>

        <label for="yearlevel">Year Level:</label><br>
        <select id="yearlevel" name="yearlevel" required>
            <option value="1">First Year</option>
            <option value="2">Second Year</option>
            <option value="3">Third Year</option>
            <option value="4">Fourth Year</option>
        </select><br>

        <label for="AY">Academic Year:</label><br>
        <input type="text" id="AY" name="AY" required><br>

        <input type="submit" value="Submit">
        <a href="./img/crs.png" class="btn">Cancel</a>
    </form>
</body>
</html>
