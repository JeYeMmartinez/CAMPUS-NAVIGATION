<?php

  session_start(); 

  if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'student')){
      echo json_encode(["status" => 'error', "message" => "Unauthorized"]);  
    exit;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/sweetalert2.min.css">
    <link rel="stylesheet" href="../Assets/animate.min.css">
    <link rel="stylesheet" href="../Assets/animate.min.css">

    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/jquery-3.7.1.min.js"></script>
    <script src="../Assets/sweetalert2.all.min.js"></script>

    <title>Way2Class</title>

  <style>

  body {
    font-family: "Poppins", sans-serif;
    background: #f4f6f9;
    margin: 40px;
  }

  table.dataTable {
    width: 100%;
    border-collapse: collapse;
  }

  th {
    background-color: #007bff;
    color: white;
  }

  td, th {
    text-align: center;
    padding: 10px;
  }

  .highlight {
    background-color: #e0f7fa;
  }

  .title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
  }

  .navbar {
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #000923ff, #002b80);
  }

  .nav-link {
    transition: color 0.2s ease;
  }

  .nav-link:hover {
    color: #004aad;
    font-weight: 500;
  }

  .navbar, .dropdown-menu{
    z-index: 1050;
    position: relative;
  } 

  </style>

</head>
<body style="background-color: white;">

<!--NAVBAR -->
  <div style="background-color: white; margin-top: -20px;" class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary  " style="padding-bottom: 20px;">
      <div class="container-fluid d-flex align-items-center justify-content-between" style="margin-bottom: -20px;">
        <a href="dashboard.php" class="animate__animated animate__fadeInLeft">
          <img src="../IMG/Way2Class-LOGO.png" alt="LOGO" style="width: 150px;">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="collapse navbar-collapse animate__animated animate__backInDown">
              <a href="" style="margin-left: 20px; text-decoration:none; color: white;" > 
                Class Schedule
              </a>
            </li>
            <li class="dropdown" class="collapse navbar-collapse" >
              <button class="btn btn-secondary dropdown-toggle animate__animated animate__backInDown" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px; text-decoration:none; color: white; border: none; background: #001846ff;">
                Buldings
              </button>
              <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item building dropdown_buildings" data-building-number="1">Main Building</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="2">Annex Building</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="5">JEG Building</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="6">Multi-Purpose Building</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="7">Covered Court</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="3">HTMD Building</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="4">Herritage</a></li>
              </ul>
            </li>
            <li class="dropdown collapse navbar-collapse">
                <button class="btn btn-secondary dropdown-toggle animate__animated animate__backInDown" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px; text-decoration:none; color: white;  border: none; background: #00194aff;">
                  Facilities
                </button>
                <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item">Registrar Office</a></li>
                <li><a href="#" class="dropdown-item building" data-building-number="20">NSTP Office</a></li>
                <li><a href="#" class="dropdown-item">OSA</a></li>
                <li><a href="#" class="dropdown-item">Printing services</a></li>
              </ul>
            </li>
            <li class="collapse navbar-collapse animate__animated animate__backInDown">
              <a href="Announcement_page.php" style="margin-left: 20px; text-decoration:none; color: white;">
                Events
              </a>
            </li>
          </ul>
          <form role="search" class="d-flex align-items-center collapse navbar-collapse animate__animated animate__backInDown" >
            <input type="search" class="form-control me-2" aria-label="search" placeholder="Search campus locations..." style="width: 300px; margin-left: 30px; border-radius: 25px;">  
            <label for="search"><span><i class="bi bi-search" type="button" style="font-size: 20px;"></i></span></label>
          </form>
          
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 collapse navbar-collapse" style="margin-left: 20px;">
            <li class="nav-item dropdown card d-flex flex-column mb-3 animate__animated animate__fadeInRight" style="width: 250px; border-radius: 20px; position: relative; top: 8px;" >
              <a href="#" class="nav-link d-flex align-items-center" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                <img src="../IMG/circle-user.svg" alt="" style="width: 40px;">
                <div class="d-flex flex-column">
                  <span style="font-family: serif; font-size: 13px; color: black; position: relative; bottom: -5px; left: 10px;"><?php echo $_SESSION['email']?></span>
                  <span style="font-size: 10px; font-family: serif; color: black; position: relative; left: 10px;"><?php echo $_SESSION['role'] ?></span>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 10px; width: 250px;" >    
                <li><a href="#" id="logoutBTN" class="dropdown-item" style="text-align: center;"><img src="../IMG/logout.svg" alt="" style="width: 25px; position: relative; right: 15px;">Logout</a></li> 
              </ul>
            </li>
          </ul>
        </div>
    </nav>
<!--END OF NAVBAR -->

<!--SCHEDULE TABLE -->
 <form id="tableform">
    <div class="">
        <h3 style="text-align: center;">MY CLASS SCHEDULE</h3>
        
        <div class="d-flex gap-3 mb-3 align-items-center">
          <label>Day:</label>
          <select id="filterDay" class="form-select" style="width: 150px;">
            <option value=" ">All</option>
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
          </select>

          <label>Building:</label>
          <select id="filterBuilding" class="form-select" style="width: 180px;">
            <option value="">All</option>
            <option value="Main Building">Main Building</option>
            <option value="Annex Building">Annex Building</option>
            <option value="HTMD Building">HTMD Building</option>
            <option value="Herritage Building">Herritage Building</option>
            <option value="Jeg Building">Jeg Building</option>
            <option value="Multi-Purpose">Multi-Purpose</option>
            <option value="Covered Court">Covered Court</option>
          </select>

          <label>Room:</label>
          <select id="filterRoom" class="form-select" style="width: 180px;">
            <option value="">All</option>
          </select>
        </div>

        <table id="scheduleTable" class="display animate__animated animate__fadeIn">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Time Starts</th>
                    <th>Time Ends</th>
                    <th>Teacher</th>
                    <th>Section</th>
                    <th>Room</th>
                    <th>Floor</th>
                    <th>Building</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                </tr>
            </tbody>
        </table>
    </div>
    </form>

  <link rel="stylesheet" href="../Assets/datatables.min.css">
  <script src="../Assets/datatables.min.js"></script>

  <script>

    $(document).ready(function() {
    const table = $('#scheduleTable').DataTable({
      ajax: {
        url: '../config/SCHEDULE.php',
        dataSrc: ''
      },
      columns: [
        { data: 'subject_name' },
        { data: 'day' },
        { data: 'time_start' },
        { data: 'time_end' },
        { data: 'teacher_name' },
        { data: 'section_name' },
        { data: 'room_id' },
        { data: 'floor_number' },
        { data: 'building_name' } 
      ]
    });

    
    $('#filterDay').on('change', function() {
      table.column(1).search(this.value).draw();
    });

    $('#filterRoom').on('change', function() {
      table.column(6).search(this.value).draw();
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