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
    <title>Way2Class - View Student Schedule</title>
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
        <div class="container-fluid d-flex align-items-center justify-content-between mb-3">
            <h1 style="margin-right: 670px">View Student Schedule</h1>
            <input type="text" class="form-control" placeholder="Enter Student ID" style="height: 45px; width: 250px;" id="searchInput"> 
            <button class="btn btn-primary" style="height: 45px; width: 120px;" id="searchBtn">Search</button>
        </div>
        
        <div class="card mt-3 shadow mb-5 p-3 bg-body-tertiary rounded small">
            <div class="card-title mx-3">
                <h2>Student Information</h2>
            </div>
            <div class="card-body mt-2" id="studentInfoDisplay">
                <div class="text-muted">Enter a student ID to view their information and schedule.</div>
            </div>
        </div>
        
        <div class="card mt-3 shadow mb-5 p-3 bg-body-tertiary rounded small">
            <div class="card-title mx-3">
                <h2>Class Schedule</h2>
            </div>
            <div class="card-body mt-2" id="scheduleTable">
                <div class="text-muted">Schedule will appear here after searching for a student.</div>
            </div>
        </div>
    </div>

    <script>
   $(document).ready(function() {

  
    function formatTime(time) {
        if (!time) return '';
        if (time.includes('AM') || time.includes('PM')) {
            return time;
        }
        
        // Convert 24h to 12h format
        var parts = time.split(':');
        var hours = parseInt(parts[0]);
        var minutes = parts[1];
        var suffix = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 12 || 12; // Convert 0 to 12 for midnight
        
        return hours + ':' + minutes + ' ' + suffix;
    }

    $('#searchBtn').on('click', function() {
        var studentID = $('#searchInput').val().trim();
        
        if(!studentID) {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "Please enter student ID."
            });
            return;
        } 

        $.get('../config/get_schedule.php', {student_id: studentID}, function(response) {
            // Debug: Log the response
            console.log('API Response:', response);
            
            if(response.success) {    
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Student information loaded successfully.",
                    timer: 1500,
                    showConfirmButton: false
                });
                
                // Display student information
                $('#studentInfoDisplay').html(
                    `<div class="d-inline-flex">
                        <div class="mx-2" style="width: 377px">
                            <label for="readID">Student ID</label>
                            <input type="text" readonly class="form-control" id="readID">
                        </div>
                        <div class="mx-2" style="width: 377px">
                            <label for="readName">Name</label>
                            <input type="text" readonly class="form-control" id="readName">
                        </div>
                        <div class="mx-2" style="width: 400px">
                            <label for="readYear">Year</label>
                            <input type="text" readonly class="form-control" id="readYear">
                        </div>
                    </div>
                    <div class="d-inline-flex p-2">
                        <div class="mx-2" style="width: 400px">
                            <label for="readSem">Semester</label>
                            <input type="text" readonly class="form-control" id="readSem">
                        </div>
                        <div class="mx-2" style="width: 40%">
                            <label for="program">Program</label> 
                            <input type="text" readonly class="form-control" id="program" name="program">
                        </div>
                        <div class="mx-2" style="width: 40%">
                            <label for="section">Section</label> 
                            <input type="text" readonly class="form-control" id="section" name="section">
                        </div>
                    </div>`
                );

                // Append Student Information
                $('#readID').val(response.student.student_id);
                $('#readName').val(response.student.first_name + ' ' + response.student.last_name);
                $('#readYear').val(response.student.year);
                $('#readSem').val(response.student.semester);
                $('#program').val(response.student.courseName);
                $('#section').val(response.student.section_name);

                // Load schedules
                loadSchedule(response.schedules);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Student not found"
                });
                $('#studentInfoDisplay').html('');
                $('#scheduleTable').html('');
            }
        }, 'json').fail(function() {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "Failed to fetch student data. Please try again."
            });
        });
    });

    // Load schedule function
    function loadSchedule(schedules) {
        if(!schedules.length) {
            $('#scheduleTable').html(`<div class="alert alert-info">No schedule found for this student.</div>`);
            return;
        }

        var display = `<table class="table table-bordered table-striped table-hover" id="scheduleDataTable">
            <thead class="table-primary">
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Professor</th>
                    <th>Room</th>
                    <th>Day</th>
                    <th>Time</th>
                </tr>   
            </thead>
            <tbody>`;
            
        schedules.forEach(function(sch) {
            display += `<tr>
                <td>${sch.subject_code}</td>
                <td>${sch.subject_name}</td>
                <td>${sch.teacher_name}</td>
                <td>${sch.room_id}</td>
                <td>${sch.day_of_week}</td>
                <td>${formatTime(sch.time_start)} - ${formatTime(sch.time_end)}</td>
            </tr>`;
        });
        
        display += `</tbody></table>`;

        
        $('#scheduleTable').html(display);
        
        // Initialize DataTables for better viewing experience
        setTimeout(function() {
            $('#scheduleDataTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "info": true,
                "order": [[4, 'asc']] // Sort by day
            });
        }, 100);
    }

    // Allow search on Enter key
    $('#searchInput').on('keypress', function(e) {
        if(e.which === 13) {
            $('#searchBtn').click();
        }
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
