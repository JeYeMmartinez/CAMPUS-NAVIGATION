<?php
    session_start();

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin')) {
        header("Location:../auth/mylogin.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../Assets/sweetalert2.min.css">
    <link rel="stylesheet" href="../Assets/css/admin_responsive.css">

    <title>Way2Class - View Student Information</title>
    
    <style>
        /* Modal layering fix */
        .sidebar {
            z-index: 1030 !important;
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1055 !important;
        }

        .modal-dialog {
            z-index: 1060 !important;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }
        
        /* Ensure modals display properly */
        .modal.show {
            display: block !important;
        }
    </style>
</head>
<body>
    
    <!-- SIDEBAR START -->
    <button class="menu-toggle" type="button">☰</button>
    <div class="sidebar-overlay"></div>
    <div class="sidebar shadow p-3 mb-5 bg-body-tertiary rounded">
        <div>
            <div class="logo">
                <a href="admin_dashboard.php">
                    <img src="../IMG/Way2Class-LOGO.png" alt="LOGO" style="width: 250px;">
                </a>
            </div>
            <nav class="nav flex-column">   
                <a class="nav-link ajax-link" href="admin_scheduleInfo.php">View Student Schedule</a>
                <a class="nav-link" href="admin_studentInfo.php">Student Information Management</a>
                <a class="nav-link" href="admin_buildings.php">Buildings Availability Management</a>
                <a class="nav-link" href="admin_announcement.php">Create Announcement</a>
                <a class="nav-link" href="admin_accountManagement.php">Account Management</a>
            </nav>
        </div>
        <div class="bottom-links">
            <a class="nav-link" href="#" id="logoutBTN">Logout</a>
        </div>
    </div>
    <!-- END OF SIDEBAR -->
    
    <div class="main-content">
        <div class="container-fluid"> 
            <h1>Student Information Management</h1>
            <div class="card mt-3 shadow mb-5 p-3 bg-body-tertiary rounded small">
                <div class="card-title mx-4 d-flex align-content-center justify-content-between"> 
                    <h2>Student Information: List</h2>
                    <button class="btn btn-success mb-3 mt-1" id="addStudent">Add New Student</button> 
                </div>
                <div class="card-body">
                    <table class="table table-responsive order-column" id="studentList">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student ID</th>
                                <th>First Name</th> 
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Section</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="addInfo">
                    <div class="modal-header">
                        <h3 class="modal-title" id="addModalLabel">Add Student</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mt-3">
                            <span class="input-group-text">Student ID</span>
                            <input type="text" class="form-control" id="add_studentID" name="student_id" required>
                            <div class="invalid-feedback">Student ID should be filled and not exceed 15 alphanumeric characters.</div>
                        </div>
                        
                        <div class="input-group mt-3">
                            <span class="input-group-text">First Name</span>
                            <input type="text" class="form-control" id="add_FirstName" name="first_name" required>
                            <div class="invalid-feedback">First name can only contain letters, spaces, hyphens, and periods.</div>
                        </div>
                        
                        <div class="input-group mt-3">
                            <span class="input-group-text">Last Name</span>
                            <input type="text" class="form-control" id="add_LastName" name="last_name" required>
                            <div class="invalid-feedback">Last Name can only contain letters, spaces, hyphens, and periods.</div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="add_Course" class="form-label">Course</label>
                                <select class="form-select" id="add_Course" name="courses_id" required>
                                    <option value="">Select a course</option>
                                    <option value="2001">BSIT</option>
                                    <option value="2003">Architecture</option>
                                </select>
                                <div class="invalid-feedback">Please select a course.</div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <label for="add_Section" class="form-label">Section</label>
                                <select class="form-select" id="add_Section" name="sections_id" required>
                                    <option value="">Select a section</option>
                                    <option value="3111">BSIT-11E3</option>
                                    <option value="3121">BSIT-12E3</option>
                                    <option value="3211">BSIT-21E3</option>
                                </select>
                                <div class="invalid-feedback">Please select a section.</div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <label for="add_year" class="form-label">Year</label>
                                <input type="text" class="form-control" name="year" id="add_year" required>
                                <div class="invalid-feedback">Year is required (alphanumeric only).</div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <label for="add_semester" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="add_semester" name="semester" required>
                                <div class="invalid-feedback">Semester is required (alphanumeric only).</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="add_confrimBtn">Add Student</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> 
            <form id="editInfo">  
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Student</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        
                        <div class="input-group mt-3">
                            <span class="input-group-text">Student ID</span>
                            <input type="text" class="form-control" id="edit_studentID" name="student_id" required>
                            <div class="invalid-feedback">Student ID should be filled and not exceed 15 alphanumeric characters.</div>
                        </div>
                        
                        <div class="input-group mt-3">
                            <span class="input-group-text">First Name</span>
                            <input type="text" class="form-control" id="edit_FirstName" name="first_name" required>
                            <div class="invalid-feedback">First Name can only contain letters, spaces, hyphens, and periods.</div>
                        </div>
                        
                        <div class="input-group mt-3">
                            <span class="input-group-text">Last Name</span>
                            <input type="text" class="form-control" id="edit_LastName" name="last_name" required> 
                            <div class="invalid-feedback">Last name can only contain letters, spaces, hyphens, and periods.</div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="edit_Course" class="form-label">Course</label>
                                <select class="form-select" id="edit_Course" name="courses_id" required>
                                    <option value="">Select a course</option>
                                    <option value="2001">BSIT</option>
                                    <option value="2003">Architecture</option>
                                </select>
                                <div class="invalid-feedback">Please select a course.</div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <label for="edit_Section" class="form-label">Section</label>
                                <select class="form-select" id="edit_Section" name="sections_id" required> 
                                    <option value="">Select a section</option>
                                    <option value="3111">BSIT-11E3</option>
                                    <option value="3121">BSIT-12E3</option>
                                    <option value="3211">BSIT-21E3</option>
                                </select>
                                <div class="invalid-feedback">Please select a section.</div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <label for="edit_year" class="form-label">Year</label>
                                <input type="text" class="form-control" name="year" id="edit_year" required>
                                <div class="invalid-feedback">Year is required (alphanumeric only).</div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <label for="edit_semester" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="edit_semester" name="semester" required> 
                                <div class="invalid-feedback">Semester is required (alphanumeric only).</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="confrimBtn">Save Changes</button>
                        <button type="button" class="btn btn-secondary" id="closeBtn" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery MUST load FIRST -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert -->
    <script src="../Assets/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- Responsive JS -->
    <script src="../Assets/js/admin_responsive.js"></script>

    <script>    
    $(document).ready(function() {
        console.log('Script loaded');

        var table = $('#studentList').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            responsive: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: '../config/fetchStudents.php',
                type: 'POST',
                dataSrc: ''
            },
            columns: [
                {data: 'id', width: '50px'},
                {data: 'student_id', width: '100px'},
                {data: 'first_name', width: '120px'},
                {data: 'last_name', width: '120px'},
                {data: 'courseName', width: '100px'}, 
                {data: 'section_name', width: '120px'},
                {data: 'year', width: '80px'},
                {data:'semester', width: '80px'},
                {
                    data: null, 
                    orderable: false,
                    searchable: false,
                    width: '150px',
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-primary btn-sm editButton" 
                                data-id="${row.id}"
                                data-student-id="${row.student_id}"
                                data-first-name="${row.first_name}"
                                data-last-name="${row.last_name}"
                                data-course="${row.courses_id || ''}"
                                data-section="${row.sections_id || ''}"
                                data-year="${row.year}"
                                data-semester="${row.semester}"> 
                            Edit 
                        </button>
                        <button class="btn btn-danger btn-sm deleteButton" data-id="${row.id}">Delete</button>`;
                    }
                }
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            pageLength: 10
        });

        // ADD BUTTON CLICK
        $('#addStudent').on('click', function(e) {
            e.preventDefault();
            console.log('Add button clicked');
            
            $('#addInfo')[0].reset();
            $('#addInfo .form-control, #addInfo .form-select').removeClass('is-invalid is-valid');
            
            var myModal = new bootstrap.Modal(document.getElementById('addModal'));
            myModal.show();
        });

        // ADD FORM SUBMIT
        $('#addInfo').on('submit', function(e) {   
            e.preventDefault();
            console.log('Add form submitted');

            $('#addInfo .form-control, #addInfo .form-select').removeClass('is-invalid is-valid');

            var valid = true;

            // Student ID validation
            var studentId = $('#add_studentID').val().trim();
            if (studentId.length === 0 || studentId.length > 15 || !/^[A-Za-z0-9\-]+$/.test(studentId)) {
                $('#add_studentID').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_studentID').addClass('is-valid');
            }

            // First/Last Name validation
            var firstName = $('#add_FirstName').val().trim();
            var lastName = $('#add_LastName').val().trim();
            var nameRegex = /^[A-Za-z\s\-.]+$/;
            if (!nameRegex.test(firstName) || firstName.length === 0) {
                $('#add_FirstName').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_FirstName').addClass('is-valid');
            }
            if (!nameRegex.test(lastName) || lastName.length === 0) {
                $('#add_LastName').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_LastName').addClass('is-valid');
            }

            // Year and Semester validation
            var year = $('#add_year').val().trim();
            var semester = $('#add_semester').val().trim();
            var alnumSpaceRegex = /^[A-Za-z0-9\s]+$/;
            if (!alnumSpaceRegex.test(year) || year.length === 0) {
                $('#add_year').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_year').addClass('is-valid');
            }
            if (!alnumSpaceRegex.test(semester) || semester.length === 0) {
                $('#add_semester').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_semester').addClass('is-valid');
            }

            // Course and Section validation
            var courseVal = $('#add_Course').val();
            var sectionVal = $('#add_Section').val();
            if (!courseVal || courseVal === "") {
                $('#add_Course').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_Course').addClass('is-valid');
            }
            if (!sectionVal || sectionVal === "") {
                $('#add_Section').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_Section').addClass('is-valid');
            }

            if (!valid) {
                console.log('Validation failed');
                return false;
            }

            console.log('Validation passed, submitting...');

            var formData = {
                student_id: studentId,
                first_name: firstName,
                last_name: lastName,
                courses_id: courseVal,
                sections_id: sectionVal,
                year: year,
                semester: semester
            };

            console.log('Sending data:', formData);

            $.ajax({
                url: '../config/addStudent.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);
                    if(response.success) {
                        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                        $('#addInfo')[0].reset();
                        Swal.fire({
                            icon: "success",
                            title: "Created Successfully!",
                            text: response.message || "Student added successfully."
                        });
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: response.message || "Failed to add student."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Connection Error!",
                        text: "Failed to connect to server. Check console for details."
                    });
                }
            });
        });

        // EDIT BUTTON CLICK
        $('#studentList').on('click', '.editButton', function(e) {
            e.preventDefault();
            $('#editInfo .form-control, #editInfo .form-select').removeClass('is-invalid is-valid');

            var id = $(this).data('id');
            var studentId = $(this).data('student-id');
            var firstName = $(this).data('first-name');
            var lastName = $(this).data('last-name');
            var course = $(this).data('course');
            var section = $(this).data('section');
            var year = $(this).data('year');
            var semester = $(this).data('semester');

            $('#edit_id').val(id);
            $('#edit_studentID').val(studentId);
            $('#edit_FirstName').val(firstName);
            $('#edit_LastName').val(lastName);
            $('#edit_Course').val(course);
            $('#edit_Section').val(section);
            $('#edit_year').val(year);
            $('#edit_semester').val(semester);

            var myModal = new bootstrap.Modal(document.getElementById('editModal'));
            myModal.show();
        });
        
        // EDIT FORM SUBMIT
        $('#editInfo').on('submit', function(e) {
            e.preventDefault();
            console.log('Edit form submitted');

            $('#editInfo .form-control, #editInfo .form-select').removeClass('is-invalid is-valid');

            var valid = true;

            // Student ID validation
            var studentId = $('#edit_studentID').val().trim();
            if (studentId.length === 0 || studentId.length > 9|| !/^[A-Za-z0-9\-]+$/.test(studentId)) {
                $('#edit_studentID').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_studentID').addClass('is-valid');
            }

            // First/Last Name validation
            var firstName = $('#edit_FirstName').val().trim();
            var lastName = $('#edit_LastName').val().trim();
            var nameRegex = /^[A-Za-z\s\-.]+$/;
            if (!nameRegex.test(firstName) || firstName.length === 0) {
                $('#edit_FirstName').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_FirstName').addClass('is-valid');
            }
            if (!nameRegex.test(lastName) || lastName.length === 0) {
                $('#edit_LastName').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_LastName').addClass('is-valid');
            }

            // Year and Semester validation
            var year = $('#edit_year').val().trim();
            var semester = $('#edit_semester').val().trim();
            var alnumSpaceRegex = /^[A-Za-z0-9\s]+$/;
            if (!alnumSpaceRegex.test(year) || year.length === 0) {
                $('#edit_year').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_year').addClass('is-valid');
            }
            if (!alnumSpaceRegex.test(semester) || semester.length === 0) {
                $('#edit_semester').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_semester').addClass('is-valid');
            }

            // Course and Section validation
            var courseVal = $('#edit_Course').val();
            var sectionVal = $('#edit_Section').val();
            if (!courseVal) {
                $('#edit_Course').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_Course').addClass('is-valid');
            }
            if (!sectionVal) {
                $('#edit_Section').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_Section').addClass('is-valid');
            }

            if (!valid) {
                console.log('Validation failed');
                return false;
            }

            var data = {
                id: $('#edit_id').val(),
                student_id: studentId,
                first_name: firstName,
                last_name: lastName,
                courses_id: courseVal,
                sections_id: sectionVal,
                year: year,
                semester: semester
            };

            console.log('Sending update data:', data);

            $.ajax({
                url: '../config/updateStudent.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log('Update response:', response);
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message || 'Student updated successfully.'
                        });
                        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message || 'Update failed.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to connect to server. Check console for details.'
                    });
                }
            });
        });

        // DELETE BUTTON
        $('#studentList').on('click', '.deleteButton', function(e) {
            e.preventDefault();
            var rowData = table.row($(this).closest('tr')).data();
            var studentId = rowData.id;

            Swal.fire({
                icon: "warning",
                title: "Are you sure?",
                text: "Do you want to delete this student?",
                confirmButtonText: "Yes, delete it!",
                showCancelButton: true,
            }).then((result) => {
                if(result.isConfirmed) {
                    $.post('../config/deleteStudent.php', {id: studentId}, function(response) {
                        if(response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Removed!",
                                text: "Student has been deleted."
                            }); 
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: response.message || "Delete failed."
                            });
                        }
                    }, 'json');
                }
            });
        });
    });

    //Logout Confirmation
    document.getElementById('logoutBTN').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../config/LOGOUT.php';
            }
        });
    });
    </script>
</body>
</html>