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

        .wrapper {
            background-color: rgba(255, 255, 255, 0.8); /* Set a white background with 80% opacity */
            padding: 20px; /* Add some padding for better readability */
            border-radius: 10px; /* Add rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a slight shadow for depth */
        }
        h2{
            margin-left: 75px;
        
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* Remove background-color property */
            color: #000; /* Set the text color to black */
            margin-left: 75px; /* Set the left margin */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5; /* Lighten the header background color */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Lighten the even row background color */
        }

        tr:hover {
            background-color: #ddd; /* Lighten the hover background color */
        }

        img {
            max-width: 100%;
            height: auto;
        }

        #iframe {
            width: 100%;
            height: 800px; /* Set height as needed */
            border: none;
            background-color: transparent; /* Set background color of iframe to transparent */
            color: #000; /* Set text color of iframe content to black */
        }
        .action-btn {
            display: flex; /* Change display to flex */
            background-color: #333; /* Darken the button background color */
            color: #fff; /* Text color for the buttons */
            border: none;
            padding: 5px 8px; /* Adjust padding */
            margin-right: 5px; /* Reduce margin between buttons */
            border-radius: 5px;
            cursor: pointer;
        }


        .action-btn:hover {
            background-color: #555; /* Darken the button background color on hover */
        }

        /* Custom styles for the font-awesome icons */
        .action-btn i {
            margin-right: 5px; /* Add some space between the icon and text */
        }
        .btn-group {
        display: flex;
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

<div class="wrapper">
    <section id="mainContent"> 
        <div id="iframe-container">
            <iframe id="iframe" src="img/crs.png" allowfullscreen></iframe>
        </div>
    </section>

    <div class="column_half right_half">
        <div class="row">
            <div class="col-md-22">
                <div class="mt-10 mb-5 clearfix">   
                    <div class="btn-group">
                        <button class="action-btn" onclick="openAddStudentForm(); showIframe();"><i class="fas fa-user-plus"></i> Add Student</button>
                        <button class="action-btn" onclick="openEnrollDetails(); showIframe();"><i class="fas fa-list-alt"></i> Enrolled Students</button>
                        <button class="action-btn" onclick="openAddSubjectForm(); showIframe();"><i class="fas fa-book"></i> Add Subject</button>
                    </div>
                </div>

                <div class="student-list">
                    <?php
                    include 'db_connect.php';

                    $sql = "SELECT * FROM students";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2>List of Students</h2>";
                        echo "<table border='1'>";
                        echo "<tr><th>Student ID</th><th>Student Name</th><th>Actions</th></tr>";
                        while($row = $result->fetch_assoc()) {
                            $full_name = $row['student_fname'] . " " . $row['student_mname'] . " " . $row['student_lname'];
                            echo "<tr>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>";
                            echo "<form action='javascript:void(0);' onclick='openViewForm(" . $row['student_id'] . ")' method='GET'>";
                            echo "<input type='hidden' name='student_id' value='" . $row['student_id'] . "'>";
                            echo "<button class='action-btn'><i class='far fa-eye'></i></button>";
                            echo "</form>";
                            echo "<form action='javascript:void(0);' onclick='openUpdateForm(" . $row['student_id'] . ")' method='GET'>";
                            echo "<input type='hidden' name='student_id' value='" . $row['student_id'] . "'>";
                            echo "<button class='action-btn'><i class='far fa-edit'></i></button>";
                            echo "</form>";
                            echo "<form action='javascript:void(0);' onclick='openDeleteForm(" . $row['student_id'] . ")' method='GET'>";
                            echo "<input type='hidden' name='student_id' value='" . $row['student_id'] . "'>";
                            echo "<button class='action-btn'><i class='far fa-trash-alt'></i></button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No results found</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showIframe() {
        var iframe = document.getElementById("iframe");
        iframe.style.display = "block";
    }
</script>

</body>
</html>
