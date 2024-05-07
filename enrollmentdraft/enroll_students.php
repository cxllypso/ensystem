<?php
require_once "db_connect.php";  

// Retrieve offered subjects details
$sql = "SELECT * FROM subjects";
$subjects_result = mysqli_query($link, $sql);

if (!$subjects_result) {
    echo '<div class="alert alert-danger">Error retrieving offered subjects.</div>';
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Offered Subjects Enrollment Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
            background-color: #7ABA78;
            font-family: 'Bookman Old Style';
            border-radius: 50px;
            padding: 20px;
        }
        .invalid-feedback {
            display: block;
            color: red;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Offered Subjects</h2>
                    </div>
                    
                    <?php if (isset($student)) : ?>
                    <div class="mt-5 mb-3">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>ID</th>
                            </tr>
                            <tr>
                                <td><?php echo htmlspecialchars($student['student_fname'] . ' ' . $student['student_mname'] . ' ' . $student['student_lname']); ?></td>
                                <td><?php echo $student['student_id']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php endif; ?>

                    <form action="process_enrollment.php" method="post">
                        <?php if (mysqli_num_rows($subjects_result) > 0) : ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Lab Units</th>
                                    <th>Lecture Units</th>
                                    <th>Description</th>
                                    <th>Year Level</th>
                                    <th>Semester</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($subjects_result)) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['subject_code']); ?></td>
                                    <td><?php echo htmlspecialchars($row['subject_name']); ?></td> 
                                    <td class="lab_unit"><?php echo htmlspecialchars($row['lab_unit']); ?></td>
                                    <td class="lec_unit"><?php echo htmlspecialchars($row['lec_unit']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['yearlevel']); ?></td>
                                    <td><?php echo htmlspecialchars($row['AY']); ?></td>
                                    <td><input type="checkbox" name="subjects[]" value="<?php echo htmlspecialchars($row['subject_code']); ?>"></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p>No subjects offered currently.</p>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="AY">Academic Year:</label>
                            <input type="text" class="form-control" id="AY" name="AY" required>
                        </div>
                        <div class="form-group">
                            <label for="miscellaneousfee">Miscellaneous Fee:</label>
                            <input type="text" class="form-control" id="miscellaneousfee" name="miscellaneousfee" required>
                        </div>
                        <div class="form-group">
                            <label for="totalFee">Total Tuition Fee:</label>
                            <input type="text" class="form-control" id="totalFee" name="totalFee" readonly>
                        </div>
                        <a href="./img/crs.png" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Enroll Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
            // Calculate total tuition fee when subjects are selected/deselected
            document.addEventListener('change', function(event) {
                if (event.target.name === 'subjects[]') {
                    var totalUnits = 0;
                    var checkboxes = document.querySelectorAll('input[name="subjects[]"]:checked');
                    if (checkboxes.length > 0) {
                        checkboxes.forEach(function(checkbox) {
                            var row = checkbox.closest('tr');
                            var lab_unit = parseInt(row.querySelector('.lab_unit').textContent);
                            var lec_unit = parseInt(row.querySelector('.lec_unit').textContent);
                            var units = lab_unit + lec_unit;
                            totalUnits += units;
                        });
                        // Calculate total fee (assuming 1 unit = 200 pesos)
                        var totalFee = totalUnits * 200;
                        // Update total fee input field
                        document.getElementById('totalFee').value = totalFee;
                    } else {
                        // Reset total fee if no subjects are selected
                        document.getElementById('totalFee').value = '';
                    }
                }
            });
        </script>
    </body>
    </html>