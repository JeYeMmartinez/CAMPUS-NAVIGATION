<?php

  session_start(); 

  if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin')){
      echo json_encode(["status" => 'error', "message" => "Unauthorized"]);  
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../Assets/css/admin_responsive.css">
    
    <!-- jQuery MUST load FIRST -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Then other scripts -->
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <!-- Responsive JS loads AFTER jQuery -->
    <script src="../Assets/js/admin_responsive.js"></script>
    <title>Way2Class - Create Announcement </title>


  <style>
        .announcement-default,
        .announcement-important,
        .announcement-homework,
        .announcement-noclass {
            background-color: #fff !important; /* Card body always white */
            border: 2px solid #adb5bd !important; /* Default border */
        }
        .announcement-important { border-color: #4a83ff !important; }
        .announcement-homework { border-color: #28a745 !important; }
        .announcement-noclass { border-color: #ffc107 !important; }

        #announcementPreview .card-header {
            background-color: #fff !important; /* Card header always white */
            color: #333 !important;
            border-bottom: 1px solid #dee2e6;
        }
  </style>
</head>
<body>
    <!-- SIDEBAR START-->
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
        <h1>Events Announcements </h1>
    <div class="d-flex gap-5 justify-content-center">
<!-- First Card -->
        <div class="card mt-3 shadow mb-5 p-0 bg-body-tertiary rounded small" style="width: 600px;">
            <div class="card-header text-center ">
               <h2> Create Announcement </h2>
            </div>
            <div class="card-body">
            <form id="announcementForm" method="POST" novalidate>
               <div class="mt-2">
                    <label for="addSubject" class="form-label">Subject <span class="text-danger">*</span></label>
                    <select name="addSubject" id="addSubject" class="form-select" required>
                        <option value="" selected> Select A Subject</option>
                        <option value="4001">MMW</option>
                        <option value="GE005">ASDFADSF</option>
                        <option value="IT105">PWET</option>
                        <option value="IT106">TEST</option>
                        <option value="IT104">TRUEE</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a subject.
                    </div>
               </div>
               <div class="mt-2">
                    <label for="addTitle" class="form-label">Announcement Title <span class="text-danger">*</span></label>
                    <input type="text" id="addTitle" name="addTitle" class="form-control" required>
                    <div class="invalid-feedback">
                        Title is required.
                    </div>
                </div>
                    <div class="mt-2">
                        <label for="addYear" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" id="addYear" name="addYear" class="form-control" required>  
                        <div class="invalid-feedback">
                            Please select a date.
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="addTime" class="form-label">Time <span class="text-danger">*</span></label>
                        <input type="time" id="addTime" name="addTime" class="form-control" required>
                        <div class="invalid-feedback">
                            Please select a time.
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="addType" class="form-label">Type of announcement <span class="text-danger">*</span></label>
                        <select name="addType" id="addType" class="form-select" required>
                            <option value="" selected>Select a type</option>
                            <option value="1">Default Announcement</option>
                            <option value="2">Important announcement</option>
                            <option value="3">Homework Announcement</option>
                            <option value="4">Suspension Class</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select an announcement type.
                        </div>
                    </div>  
                <div class="mt-2">
                    <label for="add_text" class="form-label">Announcement text <span class="text-danger">*</span></label>
                    <textarea name="add_text" id="add_text" class="form-control" rows="4" required></textarea>
                    <div class="invalid-feedback">
                        Announcement text is required.
                    </div>
                </div>
                <div class="mt-4 mb-1">
                    <button type="submit" class="btn btn-primary w-100"> Submit </button>  
                </div>
            </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
<!-- First Card -->

<!-- Second Card -->
        <div class="card mt-3 shadow mb-5 p-0 w-75 bg-body-tertiary rounded small">
            <div class="card-header text-center">
               <h2> Display Announcement </h2>
            </div>
            <div class="card-body" style="justify-items: center;">
                <div class="card  mt-3 shadow mb-5 p-0 w-75 bg-body-tertiary rounded small" id="announcementPreview">
                    <div class="card-header"> 
                        <div class="d-flex justify-content-between">
                            <p id="displayTitle" style="font-size: x-large;">Title Here</p> 
                            <p id="displayDate">Date Here</p>
                        </div> 
                        <div class="d-flex justify-content-between">
                            <p id="displaySubject">Subjects</p> 
                            <p id="displayTime">Time</p>
                        </div>

                    </div>
                    <div class="card-body">
                        <p id="displayText">Description</p>
                    </div>
                </div>
            </div>
        </div>
<!-- Second Card -->
    </div>
</div>

<script>
$(function() {
    // Live preview
     $('#addTitle, #addYear, #addTime, #addSubject, #add_text, #addType').on('keyup change', function() {
        $('#displayTitle').text($('#addTitle').val() || 'Title Here');
        $('#displayDate').text($('#addYear').val() || 'Date Here');
        $('#displayTime').text($('#addTime').val() || 'Time');
        
        // Display subject text instead of value
        var subjectText = $('#addSubject option:selected').text();
        $('#displaySubject').text(subjectText !== 'Select A Subject' ? subjectText : 'Subjects');
        
        $('#displayText').text($('#add_text').val() || 'Description');

        var type = $('#addType').val();
        var card = $('#announcementPreview');
        card.removeClass('announcement-default announcement-important announcement-homework announcement-noclass');
        if (type === '1') {
            card.addClass('announcement-default');
        } else if (type === '2') {
            card.addClass('announcement-important');
        } else if (type === '3') {
            card.addClass('announcement-homework');
        } else if (type === '4') {
            card.addClass('announcement-noclass');
        }
    });

    // Form validation and AJAX submit
    $('#announcementForm').on('submit', function(e) {
        e.preventDefault();

        // Remove previous validation states
        $('#announcementForm .form-control, #announcementForm .form-select').removeClass('is-invalid is-valid');

        var valid = true;

        // Subject validation
        var subject = $('#addSubject').val();
        if (!subject || subject === '' || $('#addSubject option:selected').text() === 'Select A Subject') {
            $('#addSubject').addClass('is-invalid');
            valid = false;
        } else {
            $('#addSubject').addClass('is-valid');
        }

        // Title validation (minimum 3 characters)
        var title = $('#addTitle').val().trim();
        if (title.length > 200) {
            $('#addTitle').addClass('is-invalid');
            valid = false;
        } else {
            $('#addTitle').addClass('is-valid');
        }

        // Date validation
        var date = $('#addYear').val();
        if (!date) {
            $('#addYear').addClass('is-invalid');
            valid = false;
        } else {
            $('#addYear').addClass('is-valid');
        }

        // Time validation
        var time = $('#addTime').val();
        if (!time) {
            $('#addTime').addClass('is-invalid');
            valid = false;
        } else {
            $('#addTime').addClass('is-valid');
        }

        // Type validation
        var type = $('#addType').val();
        if (!type || type === '' || $('#addType option:selected').text() === 'Select a type') {
            $('#addType').addClass('is-invalid');
            valid = false;
        } else {
            $('#addType').addClass('is-valid');
        }

        // Text validation (minimum 10 characters)
        var text = $('#add_text').val().trim();
        if (text.length > 500000) {
            $('#add_text').addClass('is-invalid');
            valid = false;
        } else {
            $('#add_text').addClass('is-valid');
        }

        // If validation fails, stop submission
        if (!valid) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please fill in all required fields correctly.'
            });
            return false;
        }

        // If all validations pass, submit via AJAX
        $.ajax({
            url: '../config/add_announcement.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Announcement added successfully!'
                    });
                    // Clear form and validation states
                    $('#announcementForm')[0].reset();
                    $('#announcementForm .form-control, #announcementForm .form-select').removeClass('is-valid');
                    // Reset preview
                    $('#displayTitle').text('Title Here');
                    $('#displayDate').text('Date Here');
                    $('#displayTime').text('Time');
                    $('#displaySubject').text('Subjects');
                    $('#displayText').text('Description');
                    $('#announcementPreview').removeClass('announcement-default announcement-important announcement-homework announcement-noclass');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Failed to add announcement.'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add announcement. Please try again.'
                });
                console.error('AJAX Error:', error);
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