<?php
include 'db_connect.php';

// Check if student_id is provided in the URL
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Retrieve student details including the student ID
    $student_query = "SELECT student_id, CONCAT(student_fname, ' ', student_mname, ' ', student_lname) AS Name, student_email, student_phone, date_of_birth, address FROM students WHERE student_id = $student_id";
    $student_result = $conn->query($student_query);
    $student_data = $student_result->fetch_assoc();

    // Retrieve enrolled subjects
    $enrollment_query = "SELECT subjects.subject_name
                        FROM subjects
                        INNER JOIN enrollment ON subjects.subject_code = enrollment.subject_code
                        WHERE enrollment.student_id = $student_id";
    $enrollment_result = $conn->query($enrollment_query);
    $enrolled_subjects = [];
    while ($row = $enrollment_result->fetch_assoc()) {
        $enrolled_subjects[] = $row['subject_name'];
    }

    // Retrieve payment status
    $payment_query = "SELECT * FROM payments WHERE student_id = $student_id";
    $payment_result = $conn->query($payment_query);
    $payment_data = $payment_result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrollment Details</title>
    <link rel="stylesheet" href="indexstyles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Changed background color to a light grey */
            margin: 0;
            padding: 0;
        }
        h2, h3 {
            color: #000000;
        }
        p {
            margin-bottom: 10px;
        }
        ul {
            margin-top: 0;
            padding-left: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000; /* Changed border color to black */
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #000; /* Changed header background color to black */
            color: #fff;
        }
        .btn {
            background-color: #333; /* Changed button background color to a darker grey */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .btn:hover {
            background-color: #555; /* Darkened hover color */
        }
    </style>
</head>
<body>
    <h2>Student Details</h2>
    <?php if (isset($student_data)): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Address</th>
        </tr>
        <tr>
            <td><?php echo $student_data['Name']; ?></td>
            <td><?php echo $student_data['student_id']; ?></td>
            <td><?php echo $student_data['student_email']; ?></td>
            <td><?php echo $student_data['student_phone']; ?></td>
            <td><?php echo $student_data['date_of_birth']; ?></td>
            <td><?php echo $student_data['address']; ?></td>
        </tr>
    </table>
    <h3>Enrolled Subjects</h3>
    <table>
        <?php foreach ($enrolled_subjects as $subject): ?>
        <tr>
            <td><?php echo $subject; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php if (isset($payment_data)): ?>
    <h3>Payment Details</h3>
    <table>
        <tr>
            <th>Amount Paid</th>
            <th>Payment Date</th>
        </tr>
        <tr>
            <td>PHP<?php echo $payment_data['amount']; ?></td>
            <td><?php echo $payment_data['payment_date']; ?></td>
        </tr>
    </table>
    <?php else: ?>
    <p>No payment information available.</p>
    <?php endif; ?>
    <?php else: ?>
    <p>Student not found.</p>
    <?php endif; ?>
    <a href="enroll_students.php?student_id=<?php echo $student_id; ?>" class="btn btn-primary">Enroll</a>
    <a href="./img/crs.png" class="btn btn-primary">Cancel</a>
</body>
</html>
