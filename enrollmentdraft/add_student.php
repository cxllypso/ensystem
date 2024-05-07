<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_fname = $_POST['student_fname'];
    $student_mname = $_POST['student_mname'];
    $student_lname = $_POST['student_lname'];
    $student_email = $_POST['student_email'];
    $student_phone = $_POST['student_phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];

    $sql = "INSERT INTO students (student_fname, student_mname, student_lname, student_email, student_phone, date_of_birth, address)
            VALUES ('$student_fname', '$student_mname', '$student_lname', '$student_email', '$student_phone', '$date_of_birth', '$address')";

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
    <title>Add Student</title>
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
        #addStudentForm {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            width: 400px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"],
        .btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover,
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Add Student</h2>
    <form id="addStudentForm" action="add_student.php" method="POST">
        <label for="student_fname">First Name:</label>
        <input type="text" id="student_fname" name="student_fname" required><br><br>
        
        <label for="student_mname">Middle Name:</label>
        <input type="text" id="student_mname" name="student_mname" required><br><br>

        <label for="student_lname">Last Name:</label>
        <input type="text" id="student_lname" name="student_lname" required><br><br>

        <label for="student_email">Email:</label>
        <input type="email" id="student_email" name="student_email"><br><br>
        
        <label for="student_phone">Phone:</label>
        <input type="text" id="student_phone" name="student_phone"><br><br>
        
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth"><br><br>
        
        <label for="address">Address:</label>
        <textarea id="address" name="address"></textarea><br><br>
        
        <input type="submit" value="Submit">
        <a href="./img/crs.png" class="btn">Cancel</a></p>
    </form>
</body>
</html>
