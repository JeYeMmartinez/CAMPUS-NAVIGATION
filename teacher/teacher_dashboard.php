<?php

  session_start(); 

  if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher')){
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

    html, body{
      overflow-x: hidden;
    }


    #Multi_purpose_bldg {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #Multi_purpose_bldg:hover {
      cursor: pointer;
      fill: #ffffffff;
      transform: scale(1.08);
      stroke-width: 5;
    }

    #Covered_Court {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #Covered_Court:hover {
      cursor: pointer;
      fill: #ffffffff;
      transform: scale(1.08);
      stroke-width: 5;
    }

    #HTMD_Bldg {
      transform-box: fill-box;
      transform-origin: center;
      transition: transform 0.80 ease-in-out;
    }

    #HTMD_Bldg:hover {
      cursor: pointer;
      fill: #ffffffff;
      transform: scale(1.08);
      stroke-width: 3;
    }

    #NSTP_Office {
      transform-box: fill-box;
      transform-origin: center center;
    }

    #NSTP_Office:hover {
      cursor: pointer;
      fill: #ffffffff;
      stroke-width: 5;
    }

    #JEG_building {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #JEG_building:hover {
      cursor: pointer;
      fill: #ffffffff;
      transform: scale(1.08);
      stroke-width: 5;
    }

    #Annex_building {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #Annex_building:hover {
      cursor: pointer;
      fill: #ffffffff;
      transform: scale(1.08);
      stroke-width: 5;
    }

    #Main_building {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #Main_building:hover {
      cursor: pointer;
      fill: #ffffffff;
      transform: scale(1.08);
      stroke-width: 5;
    }

    #Herritage {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }
  

    #Herritage:hover {
      cursor: pointer;
      fill:  #ffffffff;
      transform: scale(1.08);
      stroke-width: 5;
    }

    #kubo6 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo6:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo9 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo9:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo8 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo8:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo7:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo7 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo1:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo1 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo5:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo5 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo10:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo10 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo2:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo2 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }
    
    #kubo4:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo4 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    #kubo3:hover {
      cursor: pointer;
      fill:  #ffffffff;
      stroke-width: 2;
    }

    #kubo3 {
      transform-box: fill-box;
      transform-origin: center center;
      transition: transform 0.80 ease-in-out;
    }

    .default-state {
      text-align: center;
      color: #6b7280;
      margin-bottom: 14px;
    }

    .default-state p {
      margin-bottom: 8px;
    }

    svg .building {
    transition: stroke 0.15s ease, stroke-width 0.15s ease;
    cursor: pointer;
  }

  
  svg .building.selected,
  svg .building.selected * {
    stroke: #007bff;        
    stroke-linejoin: round;
    stroke-linecap: round;
    stroke-width: 10;
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

  .map-container{
    z-index: 1;
    position: relative;
    border-radius: 15px;
    padding: 10px;
    box-shadow: inset 0 0 20px rgba(0,0,0,0.3);
  }

  #svg-tooltip {
    position: absolute;
    pointer-events: none;
    background: rgb(0, 31, 94, 0.95);
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    white-space: nowrap;
    transform-origin:left top ;
    opacity: 0;
    transition: opacity 120ms ease, transform 120ms ease;
    z-index: 9999; 
  }
  
  #svg-tooltip.show {
    opacity: 1;
    transform: translate(0);
  }

  .room-btn {
    display: block;
    width: 100%;
    text-align: left;
    background: #f8f9fa;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin: 5px 0;
    padding: 8px 12px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.2;
  }

  .room-btn:hover {
    background: #007bff;
    color: white;
  }

  .floor-btn {
    margin-right: 10px;
  }

  #School_entrance {
    stroke: #1e8449;
    stroke-width: 2;
    cursor: pointer;
  }

  #School_entrance:hover {
    opacity: 0.7;
    fill: white;
  }

  #School_exit {
    stroke: #922b21;
    stroke-width: 2;
    cursor: pointer;
  }

  #School_exit:hover {
    fill: white;
    opacity: 0.7;
  }

  #parking_entrance {
    stroke: #1e8449;
    stroke-width: 2;
    cursor: pointer;
  }

  #parking_entrance:hover {
    fill: white;
    opacity: 0.7;
  }

  #parking_exit {
    stroke: #922b21;
    stroke-width: 2;
    cursor: pointer;
  }

  #parking_exit:hover {
    fill: white;
    opacity: 0.7;
  }

  .legend {
    z-index: 100;
  }

  #legendCollapse {
    z-index: 9999 !important;
    position: absolute;
  }

  .legend-card {
    position: absolute;
    top: 110px;
    left: 390px;
    z-index: 20;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 10px;
    width: 140px;
    text-align: left;
    transition: all 0.3s ease
  }

  .legend-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
  }

  .legend-btn {
    font-size: 13px;
    width: 100%;
    text-align: left;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 6px;
  }

  .legend-body {
    width: 230px;
    margin-top: 6px;
    background-color: #ffffff;
    border: 1px solid #e3e6ea;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .legend-link {
    font-size: 13px;
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.2s ease;
  } 


  .legend-link:hover {
    color: #0a58ca;
    text-decoration: underline;
  }

  .legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #0d6efd;
    padding: 6px 4px;
    border-radius: 6px;
    transition: background 0.2s ease;
  }

  .legend-item:hover {
  background: #f1f3f5;
  }

  .legend-color {
    width: 14px;
    height: 14px;
    border-radius: 3px;   
    margin-right: 8px;
    border: 1px solid black;
  }

  .legend-link.disabled {
    color: gray;
    text-decoration: line-through;
    opacity: 0.6;
  }

  .Comfort_Rooms {
    stroke: white;
    stroke-width: 1;  
  }

  #comfort_room {
    background: black;
    border-color: white;
    border-width: 2;
  }

  .active-schedule {
    filter: drop-shadow(0 0 10px gold) brightness(1.5);
    animation: pulse 1.6s ease-in-out infinite;
  }

  @keyframes pulse {
    0%, 100% {filter: drop-shadow(0 0 12px gold) brightness(1.5); }
    50% {filter: drop-shadow(0 0 25px orange) brightness(2); }
  }

  .btn-warning {
    background-color: gold !important;
    color: black !important;
    animation: blink 1s infinite alternate;
  }

  @keyframes blink {
    from { filter: brightness(1); }
    to { filter: brightness(1.7); }
  }

  </style>

</head>
<body style="background-color: grey;">

<!--NAVBAR -->
  <div style="background-color: white; margin-top: -20px;" class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary  " style="padding-bottom: 20px;">
      <div class="container-fluid d-flex align-items-center justify-content-between" style="margin-bottom: -20px;">
        <a class="animate__animated animate__fadeInLeft" href="teacher_dashboard.php">
          <img src="../IMG/Way2Class-LOGO.png" alt="LOGO" style="width: 150px;">
        </a>
        <!-- Mobile-only button to open sidepanel as offcanvas -->
        <button class="btn btn-outline-light d-lg-none ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidepanelOffcanvas" aria-controls="mobileSidepanelOffcanvas" aria-label="Open details">
          Details
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="collapse navbar-collapse animate__animated animate__backInDown">
              <a href="class_sched_teacher.php" style="margin-left: 20px; text-decoration:none; color: white;" > 
                Schedule
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
                <li><a href="#" class="dropdown-item">Admission Office</a></li>
                <li><a href="#" class="dropdown-item">Production Office</a></li>
                <li><a href="#" class="dropdown-item"></a></li>
              </ul>
            </li>
            <li class="collapse navbar-collapse animate__animated animate__backInDown">
              <a href="teacher_announcement.php" style="margin-left: 20px; text-decoration:none; color: white;">
                Announcement
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



<!--CONTENT -->
  <div class="map-container rounded float-end animate__animated animate__zoomIn" style="margin-top: -20px; margin-right: -25px;" id="map_container">
    <?php include "../MAP/Campus_Map_Version4.svg";?>
  </div>

<!--SIDEBAR MAP GUIDE-->


  <div class="card animate__animated animate__slideInLeft position-sticky" id="Sidepanel" style="height: 600px; overflow-y: auto;">
    <div class="card-header" style="background-color: white;">
      <div card="container">
        <h4 style="text-align: center;">NCST Campus Map Guide</h2>
        <p style="text-align: center;">National College of Science and Technology - Interactive Campus Guide</p>
      </div> 
      </div>
      <div class="card-body overflow-auto" id="sidepanel">
        <div class="building-card hidden" id="building-details">
          <div class="building-header border rounded d-flex flex-column mb-3">
            <h5 class="p-2" style="font-size: 15px; text-align: center; " id="display_building_name"> </h5>
            <p class="p-2" id="display_building_description" style="text-align: center;" ></p>
            <p class="p-2" id="display_building_floors" style="text-align: center;"></p>
            <p class="p-2" id="display_building_rooms" style="text-align: center;"></p>
  <!--DEFAULT STATE -->

            <div class="default-state" id="default-state">
              <i data-lucide="map-pin" class="default-icon"></i>
              <p>Click on a building to view details</p>
              <p class="subtitle">Hover over buildings to see their names</p>
            </div>
  <!--END OF DEFAULT STATE -->
          </div>
        </div>
      </div>
  </div>
<!--END OFSIDEBAR MAP GUIDE-->
 

<!--ROOM SIDE BAR -->

  <div class="offcanvas offcanvas-end" tabindex="-1" id="roomOffcanvas">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="roomTitle">Room Details</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>  
    <div class="offcanvas-body" id="roomBody">
      <p>Select a room to view details.</p>
    </div>
  </div>

  <div class="legend-card animate__animated animate__zoomIn" >
    <button class="btn btn-light legend-btn" style="font-size: 12px; width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#legendCollapse" aria-expanded="false" aria-controls="legendCollapse">
      <img src="../IMG/circle-question.svg" style="width: 20px;" alt="">
      Legend
    </button>

    <div class="collapse" id="legendCollapse" style="width: 200px; z-index: 1000;">
      <div class="legend-body card card-body">
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">School Entrance</a>
          <span class="legend-color p-2 flex-shrink-1" style="position: relative; left: 53px;" data-type="School_entrance"></span>
        </div>
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">School Exit</a>
          <span class="legend-color p-2 flex-shrink-1" style="position: relative; left: 80px;" data-type="School_exit"></span>
        </div>
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">Parking Entrance</a>
          <span class="legend-color p-2 flex-shrink-1" style="position: relative; left: 52px;" data-type="parking_entrance"></span>
        </div>
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">Parking Exit</a>
          <span class="legend-color p-2 flex-shrink-1" style="position: relative; left: 80px;" data-type="parking_exit"></span>
        </div>
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">Comfort Rooms</a>
          <span id="comfort_room" class="legend-color p-2 flex-shrink-1" style="position: relative; left: 55px;" data-type="CR"></span>
        </div>
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">Parking Entrance Way</a>
          <span class="legend-color p-2 flex-shrink-1" style="position: relative; left: 28px;" data-type="entrance_arrow"></span>
        </div>
        <div class="legend-item d-flex">
          <a href="#" role="button" style="font-size: 12px; text-decoration: none; color: black;" class="legend-link p-2">Parking Exit Way</a>
          <span class="legend-color p-2 flex-shrink-1" style="position: relative; left: 55px;" data-type="exit_arrow"></span>
        </div>
      </div>
  </div>
  </div>  

  <div id="tooltip"></div>

  <!-- Mobile offcanvas wrapper for the existing Sidepanel (content is moved in/out via JS) -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidepanelOffcanvas" aria-labelledby="mobileSidepanelLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="mobileSidepanelLabel">Map Details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="mobileSidepanelBody">
      <!-- #Sidepanel will be moved here on small screens -->
    </div>
  </div>

  <script>
    (function () {
      var mq = window.matchMedia('(max-width: 767.98px)');
      var sidepanel = document.getElementById('Sidepanel');
      var mobileBody = document.getElementById('mobileSidepanelBody');
      var originalParent = sidepanel ? sidepanel.parentNode : null;

      function moveForMobile(e) {
        if (!sidepanel || !mobileBody) return;
        if (mq.matches) {
        
          if (!mobileBody.contains(sidepanel)) {
            mobileBody.appendChild(sidepanel);
          }
        } else {
        
          if (originalParent && !originalParent.contains(sidepanel)) {
            originalParent.insertBefore(sidepanel, originalParent.lastElementChild.nextSibling);
          }
        }
      }

      mq.addEventListener ? mq.addEventListener('change', moveForMobile) : mq.addListener(moveForMobile);
      document.addEventListener('DOMContentLoaded', moveForMobile);

      setTimeout(moveForMobile, 100);
    })();

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

  <script src="../Assets/js/dashboard.js"></script>
</body>
</html>