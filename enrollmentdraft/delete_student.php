<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM students WHERE student_id=$student_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'img/crs.png';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        div {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        p {
            margin-bottom: 10px;
        }
        input[type="submit"], a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        input[type="submit"]:hover, a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div>
        <div>
            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div>
                        <?php
                        // Check if student ID is set and not empty
                        if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
                            $student_id = $_GET['student_id'];
                            echo "<input type='hidden' name='student_id' value='" . $student_id . "'>";
                            echo "<p>Are you sure you want to delete this student record?</p>";
                            echo "<p>";
                            echo "<input type='submit' value='Yes'>";
                            echo "<a href='./img/crs.png' class='btn btn-primary'>Cancel</a>";
                            echo "</p>";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</body>
</html>
