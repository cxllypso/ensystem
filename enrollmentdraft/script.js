    function openEnrollDetails() {
        var iframe = document.getElementById('iframe');
        iframe.src = 'enrollment.php';
    }
    function openAddStudentForm() {
        var iframe = document.getElementById('iframe');
        iframe.src = 'add_student.php';
    }

    function openAddSubjectForm() {
        var iframe = document.getElementById('iframe');
        iframe.src = 'add_subject.php';
    }
    function openViewForm(studentId) {
        var iframe = document.getElementById('iframe');
        iframe.src = 'view_students_details.php?student_id=' + studentId;
    }

    function openUpdateForm(studentId) {
        var iframe = document.getElementById('iframe');
        iframe.src = 'update_student.php?student_id=' + studentId;
    }
    

    function openDeleteForm(studentId) {
        var iframe = document.getElementById('iframe');
        iframe.src = 'delete_student.php?student_id=' + studentId;
    }
    document.getElementById("student_search").addEventListener("input", function() {
        var searchValue = this.value.trim();
        var searchResults = document.getElementById("search_results");
        
        if (searchValue !== "") {
            fetch("search_students.php?search=" + encodeURIComponent(searchValue))
            .then(response => response.text())
            .then(data => {
                searchResults.innerHTML = data;
            });
        } else {
            searchResults.innerHTML = "";
        }
    });
    
    // Function to set the selected student ID
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("search-result")) {
            var studentId = e.target.getAttribute("data-student-id");
            document.getElementById("student_id").value = studentId;
            document.getElementById("student_search").value = e.target.textContent;
            document.getElementById("search_results").innerHTML = "";
        }
    });
