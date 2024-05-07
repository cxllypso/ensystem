<?php
include 'db_connect.php';

// Check if student ID is provided in the URL
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Retrieve student details based on the student ID
    $sql = "SELECT * FROM students WHERE student_id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Student data found, populate the form fields
        $row = $result->fetch_assoc();
        $student_fname = $row['student_fname'];
        $student_mname = $row['student_mname'];
        $student_lname = $row['student_lname'];
        $student_email = $row['student_email'];
        $student_phone = $row['student_phone'];
        $date_of_birth = $row['date_of_birth'];
        $address = $row['address'];
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Student ID not provided.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Student</h2>
    <form action="update_student.php" method="POST">
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        
        <label for="student_fname">First Name:</label>
        <input type="text" id="student_fname" name="student_fname" value="<?php echo $student_fname; ?>" required><br><br>
        
        <label for="student_mname">Middle Name:</label>
        <input type="text" id="student_mname" name="student_mname" value="<?php echo $student_mname; ?>"><br><br>

        <label for="student_lname">Last Name:</label>
        <input type="text" id="student_lname" name="student_lname" value="<?php echo $student_lname; ?>" required><br><br>

        <label for="student_email">Email:</label>
        <input type="email" id="student_email" name="student_email" value="<?php echo $student_email; ?>"><br><br>
        
        <label for="student_phone">Phone:</label>
        <input type="text" id="student_phone" name="student_phone" value="<?php echo $student_phone; ?>"><br><br>
        
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>"><br><br>
        
        <label for="address">Address:</label>
        <textarea id="address" name="address"><?php echo $address; ?></textarea><br><br>
        
        <input type="submit" value="Update">
        <a href="./img/crs.png" class="btn btn-primary">Cancel</a></p>
    </form>
</body>
</html>
