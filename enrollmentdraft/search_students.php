<?php
// Include database connection
include 'db_connect.php';

// Check if search query is provided
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Prepare SQL statement to search for students by name
    $sql = "SELECT student_id, CONCAT(student_fname, ' ', student_mname, ' ', student_lname) AS student_name
            FROM students
            WHERE CONCAT(student_fname, ' ', student_mname, ' ', student_lname) LIKE '%$search%'
            ORDER BY student_fname";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display search results as options
        while ($row = $result->fetch_assoc()) {
            echo "<div class='search-result' data-student-id='" . $row['student_id'] . "'>" . $row['student_name'] . "</div>";
        }
    } else {
        // No matching students found
        echo "<div>No matching students found</div>";
    }
} else {
    // No search query provided
    echo "<div>Please enter a search query</div>";
}
?>
