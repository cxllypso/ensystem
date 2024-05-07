<?php
session_start();
require_once "db_connect.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $selectedSubjects = $_POST['subjects']; // Assuming you have checkboxes for subjects
    $AY = $_POST['AY'];
    $miscellaneousFee = $_POST['miscellaneous_fee'];
    $totalFee = $_POST['amount'];
    $student_id = $_POST['student_id']; // Assuming you have a field for student ID in your form
    $payment_date = date('Y-m-d'); // Assuming you want to record the current date
    $receipt_no = $_POST['receipt_no']; // Assuming you have a field for receipt number in your form

    // Validate and sanitize the data (to prevent SQL injection)
    // You should implement proper validation and sanitation according to your requirements

    // Example validation: Check if required fields are not empty
    if (empty($selectedSubjects) || empty($AY) || empty($miscellaneousFee) || empty($totalFee) || empty($student_id) || empty($receipt_no)) {
        // Handle validation errors
        echo "Please fill out all required fields.";
        exit;
    }

    // Insert the form data into the database using SQL INSERT queries
    $enrollmentInsertQuery = "INSERT INTO enrollment (student_id, AY) VALUES ('$student_id', '$AY')";
    $enrollmentResult = mysqli_query($link, $enrollmentInsertQuery);

    if (!$enrollmentResult) {
        // Handle database insertion error
        echo "Error: Unable to enroll student. Please try again later.";
        exit;
    }

    // Get the auto-generated enrollment ID
    $enrollmentId = mysqli_insert_id($link);

    // Loop through selected subjects and insert them into the database
    foreach ($selectedSubjects as $subject) {
        $subjectInsertQuery = "INSERT INTO subenrolled (enrollment_id, subject_code) VALUES ('$enrollmentId', '$subject')";
        $subjectResult = mysqli_query($link, $subjectInsertQuery);

        if (!$subjectResult) {
            // Handle subject insertion error
            echo "Error: Unable to enroll student in subject. Please try again later.";
            exit;
        }
    }

    // Insert payment information
    $paymentInsertQuery = "INSERT INTO payments (student_id, tuition_fee, miscellaneous_fee, payment_date, amount, receipt_no) VALUES ('$student_id', '$totalFee', '$miscellaneousFee', '$payment_date',  '$totalFee', '$receipt_no')";
    $paymentResult = mysqli_query($link, $paymentInsertQuery);

    if (!$paymentResult) {
        // Handle payment insertion error
        echo "Error: Unable to record payment. Please try again later.";
        exit;
    }

    // Redirect the user to a success page or display a success message
    header("Location: enrollment_success.php");
    exit;
} else {
    // If the form was not submitted via POST method, redirect the user to the enrollment page or display an error message
    header("Location: enrollment_form.php");
    exit;
}
?>
