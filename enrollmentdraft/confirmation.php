<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
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
        .container {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        p {
            margin-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 5px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirmation</h2>
        <?php if (isset($student_data)): ?>
            <p><strong>Student Name:</strong> <?php echo $student_data['student_fname'] . ' ' . $student_data['student_lname']; ?></p>
            <p><strong>Email:</strong> <?php echo $student_data['student_email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $student_data['student_phone']; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $student_data['date_of_birth']; ?></p>
            <p><strong>Address:</strong> <?php echo $student_data['address']; ?></p>
            
            <h3>Enrolled Subjects</h3>
            <ul>
                <?php foreach ($enrolled_subjects as $subject): ?>
                    <li><?php echo $subject; ?></li>
                <?php endforeach; ?>
            </ul>
            
            <?php if (isset($payment_data)): ?>
                <h3>Payment Details</h3>
                <p><strong>Amount Paid:</strong> PHP <?php echo $payment_data['amount']; ?></p>
                <p><strong>Payment Date:</strong> <?php echo $payment_data['payment_date']; ?></p>
            <?php else: ?>
                <p>No payment information available.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Student not found.</p>
        <?php endif; ?>
        
        <a href="index.php" class="btn">Done</a>
    </div>
</body>
</html>
