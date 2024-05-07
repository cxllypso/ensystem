<?php
// Include database connection
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $student_fname = $_POST['student_fname'];
    $student_mname = $_POST['student_mname'];
    $student_lname = $_POST['student_lname'];
    $student_email = $_POST['student_email'];
    $student_phone = $_POST['student_phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];

    // Update student record in the database
    $sql = "UPDATE students SET student_fname=?, student_mname=?, student_lname=?, student_email=?, student_phone=?, date_of_birth=?, address=? WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $student_fname, $student_mname, $student_lname, $student_email, $student_phone, $date_of_birth, $address, $student_id);

    if ($stmt->execute()) {
        // Record updated successfully
        header("Location: view_students_details.php?student_id=$student_id"); // Redirect to student details page
        exit();
    } else {
        // Error updating record
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            color: #000; /* Changed font color to black */
        }
        h2 {
            color: #000; /* Changed font color to black */
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
            background-color: #000; /* Changed button background color to black */
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
            background-color: #333; /* Changed button background color on hover */
        }
    </style>
</head>
<body>
    <h2>Edit Student Details</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        <label for="student_fname">First Name:</label>
        <input type="text" id="student_fname" name="student_fname" value="<?php echo $student_fname; ?>" required><br>
        
        <label for="student_mname">Middle Name:</label>
        <input type="text" id="student_mname" name="student_mname" value="<?php echo $student_mname; ?>" required><br>

        <label for="student_lname">Last Name:</label>
        <input type="text" id="student_lname" name="student_lname" value="<?php echo $student_lname; ?>" required><br>

        <label for="student_email">Email:</label>
        <input type="email" id="student_email" name="student_email" value="<?php echo $student_email; ?>"><br>
        
        <label for="student_phone">Phone:</label>
        <input type="text" id="student_phone" name="student_phone" value="<?php echo $student_phone; ?>"><br>
        
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>"><br>
        
        <label for="address">Address:</label>
        <textarea id="address" name="address"><?php echo $address; ?></textarea><br>
        
        <input type="submit" value="Update">
        <a href="./img/crs.png" class="btn btn-primary">Cancel</a>
    </form>
</body>
</html>
