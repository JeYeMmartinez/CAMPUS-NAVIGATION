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
    <title>Way2Class - Management Dashboard</title>
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
    <div class="main-content" id="main-content">
        <h2>Student Management</h2>
        <div class="card mb-4 shadow p-3 mb-5 bg-body-tertiary rounded" style="max-width: 600px;" id="first-card">
            <div class="card-body">
                <h5 class="card-title">Welcome, Admin!</h5>
                <p class="card-text">All systems are running smoothly.</p>
            </div>
        </div>
        <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <div class="card-text">
                    <h5 class="card-title">Student Database</h5>
                    <table class="table table-responsive" id="studentTable">
                      <thead>
                          <tr>
                            <th> Student ID</th>
                            <th> Name </th>
                            <th> Section </th>
                            <th> Course </th>
                            <th> Year </th>
                            <th> Semester</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


<script>
$(document).ready(function() {
 
        // Add hamburger button and overlay
        $('body').prepend('<button class="menu-toggle">☰</button>');
        $('body').prepend('<div class="sidebar-overlay"></div>');

        // Toggle sidebar
        $('.menu-toggle').on('click', function() {
            $('.sidebar').toggleClass('active');
            $('.sidebar-overlay').toggleClass('active');
            $('body').toggleClass('menu-open');
        });

        // Close sidebar when overlay is clicked
        $('.sidebar-overlay').on('click', function() {
            $('.sidebar').removeClass('active');
            $('.sidebar-overlay').removeClass('active');
            $('body').removeClass('menu-open');
        });

        // Close sidebar when a nav link is clicked (mobile)
        $('.sidebar .nav-link').on('click', function() {
            if ($(window).width() <= 768) {
                $('.sidebar').removeClass('active');
                $('.sidebar-overlay').removeClass('active');
                $('body').removeClass('menu-open');
            }
        });

        

    $('#studentTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        responsive: true,
        scrollX: true, // Enable horizontal scrolling on mobile
        autoWidth: false,
        ajax: {
            url: '../config/fetchStudents.php',
            type: 'POST',
            dataSrc: ''
        },
        columns: [
            {data: 'student_id', width: '100px'},
            {data: 'first_name', width: '120px'},
            {data: 'last_name', width: '120px'},
            {data: 'courseName', width: '100px'}, 
            {data: 'section_name', width: '120px'},
            {data: 'year', width: '80px'},

        ],
        // Better mobile pagination
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10
    });
});


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


