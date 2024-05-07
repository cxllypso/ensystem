<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="indexstyles.css"> 
    <title>Enrollment System</title>
    <style>
        /* Custom styles for the navbar */
        .navbar {
            background-color: transparent; /* Make the navbar background transparent */
        }

        .navbar-brand {
            color: #000; /* Text color for the brand */
            font-weight: bold; /* Bold font weight for the brand */
        }

        .navbar-nav .nav-link {
            color: #000; /* Text color for the links */
        }

        .navbar-nav .nav-link:hover {
            background-color: #333; /* Darken the background color on hover */
        }

        body {
            /* Remove background-color property */
            margin: 0; 
            font-family: Arial, sans-serif; 
            color: #000; /* Change the text color to black */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-attachment: fixed; /* Fix the background image */
        }

        
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        border: 2px solid #fff; /* Changed border color to white */
    }
    th, td {
        border: 1px solid #fff; /* Changed border color to white */
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #000; /* Changed header background color to black */
        color: white;
    }
    /* Apply stripes */
    tr:nth-child(even) {
        background-color: #f2f2f2; /* Grey */
    }
    tr:nth-child(odd) {
        background-color: #ffffff; /* White */
    }
</style>
</head>
<body>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light">
    <span class="navbar-brand">Enrollment System</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_subjects.php">Subjects</a>
            </li>
        </ul>
    </div>
</nav>
<?php
include 'db_connect.php';

// SQL query to fetch all subjects from the database
$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);

// Check if there are any subjects
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Subject Code</th><th>Subject Name</th><th>Lab Unit</th><th>Lec Unit</th><th>Description</th><th>AY</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
       
        echo "<td>" . $row["subject_code"]. "</td>";
        echo "<td>" . $row["subject_name"]. "</td>";
        echo "<td>" . $row["lab_unit"]. "</td>";
        echo "<td>" . $row["lec_unit"]. "</td>";
        echo "<td>" . $row["description"]. "</td>";
        echo "<td>" . $row["AY"]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No subjects found";
}
$conn->close();
?>
</body>
</html>
