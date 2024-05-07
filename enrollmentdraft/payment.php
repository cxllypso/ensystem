<?php
include 'db_connect.php';

// Function to retrieve payment details for a specific student
function getPaymentDetails($student_id) {
    global $conn;
    $payment_query = "SELECT *, tuition_fee + miscellaneous_fee AS amount FROM payments WHERE student_id = $student_id";
    $payment_result = $conn->query($payment_query);
    return $payment_result->fetch_assoc();
}

// Function to add a new payment record
function addPayment($student_id, $tuition_fee, $miscellaneous_fee, $payment_date) {
    global $conn;
    $amount = $tuition_fee + $miscellaneous_fee; // Calculate total amount
    $insert_query = "INSERT INTO payments (student_id, tuition_fee, miscellaneous_fee, amount, payment_date) VALUES ('$student_id', '$tuition_fee', '$miscellaneous_fee', '$amount', '$payment_date')";
    return $conn->query($insert_query);
}

// Function to update an existing payment record
function updatePayment($student_id, $tuition_fee, $miscellaneous_fee, $payment_date) {
    global $conn;
    $amount = $tuition_fee + $miscellaneous_fee; // Calculate total amount
    $update_query = "UPDATE payments SET tuition_fee = '$tuition_fee', miscellaneous_fee = '$miscellaneous_fee', amount = '$amount', payment_date = '$payment_date' WHERE student_id = $student_id";
    return $conn->query($update_query);
}

// Check if form is submitted for adding/updating payment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $tuition_fee = $_POST['tuition_fee'];
    $miscellaneous_fee = $_POST['miscellaneous_fee'];
    $payment_date = $_POST['payment_date'];

    // Calculate total amount
    $amount = $tuition_fee + $miscellaneous_fee;

    // Check if payment record already exists for the student
    $existing_payment = getPaymentDetails($student_id);

    if ($existing_payment) {
        // Update existing payment record
        $update_result = updatePayment($student_id, $tuition_fee, $miscellaneous_fee, $payment_date);
        if ($update_result) {
            echo "Payment updated successfully.";
        } else {
            echo "Error updating payment.";
        }
    } else {
        // Add new payment record
        $add_result = addPayment($student_id, $tuition_fee, $miscellaneous_fee, $payment_date);
        if ($add_result) {
            echo "Payment added successfully.";
        } else {
            echo "Error adding payment.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Management</title>
    <!-- Add CSS styling here if needed -->
</head>
<body>
    <h2>Payment Management</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="student_id" value="<?php echo isset($_GET['student_id']) ? $_GET['student_id'] : ''; ?>">
        <label for="tuition_fee">Tuition Fee:</label>
        <input type="text" id="tuition_fee" name="tuition_fee" required><br>
        <label for="miscellaneous_fee">Miscellaneous Fee:</label>
        <input type="text" id="miscellaneous_fee" name="miscellaneous_fee" required><br>
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" value="<?php echo isset($existing_payment['amount']) ? $existing_payment['amount'] : ''; ?>" required readonly><br>
        <label for="payment_date">Payment Date:</label>
        <input type="date" id="payment_date" name="payment_date" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
