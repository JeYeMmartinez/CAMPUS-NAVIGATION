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
    <link rel="stylesheet" href="../Assets/css/teacher_responsive.css">
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
      transition: transfo rm 0.80 ease-in-out;
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


<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h1 class="mb-4 text-lg-start">Events Announcements</h1>
        
        <div class="row g-4">
            <!-- Create Announcement Card -->
            <div class="col-12 col-lg-6">
                <div class="card shadow bg-body-tertiary rounded h-100">
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="h4 mb-0">Create Announcement</h2>
                    </div>
                    <div class="card-body">
                        <form id="announcementForm" method="POST" novalidate>
                            <div class="mb-3">
                                <label for="addSubject" class="form-label">
                                    Subject <span class="text-danger">*</span>
                                </label>
                                <select name="addSubject" id="addSubject" class="form-select" required>
                                    <option value="" selected>Select A Subject</option>
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

                            <div class="mb-3">
                                <label for="addTitle" class="form-label">
                                    Announcement Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="addTitle" name="addTitle" 
                                       class="form-control" 
                                       placeholder="Enter title here"
                                       maxlength="500" required>
                                <div class="invalid-feedback">
                                    Invalid input.
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="addYear" class="form-label">
                                        Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" id="addYear" name="addYear" 
                                           class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please select a date.
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="addTime" class="form-label">
                                        Time <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" id="addTime" name="addTime" 
                                           class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please select a time.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="addType" class="form-label">
                                    Type of Announcement <span class="text-danger">*</span>
                                </label>
                                <select name="addType" id="addType" class="form-select" required>
                                    <option value="" selected>Select a type</option>
                                    <option value="1">Default Announcement</option>
                                    <option value="2">Important Announcement</option>
                                    <option value="3">Homework Announcement</option>
                                    <option value="4">Suspension Class</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select an announcement type.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="add_text" class="form-label">
                                    Announcement Text <span class="text-danger">*</span>
                                </label>
                                <textarea name="add_text" id="add_text" 
                                          class="form-control" 
                                          rows="4" 
                                          placeholder="Enter announcement details here"
                                          maxlength="10000" required></textarea>
                                <div class="invalid-feedback">
                                    Announcement text is required.
                                </div>
                                <small class="text-muted">
                                    <span id="charCount">0</span>/10000 characters
                                </small>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Submit Announcement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Preview Announcement Card -->
            <div class="col-12 col-lg-6">
                <div class="card shadow bg-body-tertiary rounded h-100">
                    <div class="card-header text-center bg-success text-white">
                        <h2 class="h4 mb-0">Preview Announcement</h2>
                    </div>
                    <div class="card-body d-flex  justify-content-center">
                        <div class="card shadow announcement-default" 
                             id="announcementPreview" 
                             style="width: 100%; max-width: 500px;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <h3 id="displayTitle" class="h5 mb-0 flex-grow-1">Title Here</h3>
                                    <span id="displayDate" class="text-muted small">Date Here</span>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap gap-2 mt-2">
                                    <span id="displaySubject" class="badge bg-secondary">Subjects</span>
                                    <span id="displayTime" class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>Time
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p id="displayText" class="mb-0">Description</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

<script>
    $(function() {
    // Character counter for textarea
    $('#add_text').on('input', function() {
        const count = $(this).val().length;
        $('#charCount').text(count);
        
        // Change color based on usage
        if (count > 9000) {
            $('#charCount').addClass('text-danger').removeClass('text-warning text-muted');
        } else if (count > 7000) {
            $('#charCount').addClass('text-warning').removeClass('text-danger text-muted');
        } else {
            $('#charCount').addClass('text-muted').removeClass('text-danger text-warning');
        }
    });

    // Live preview with better formatting
    $('#addTitle, #addYear, #addTime, #addSubject, #add_text, #addType').on('keyup change', function() {
        // Update title
        const title = $('#addTitle').val().trim();
        $('#displayTitle').text(title || 'Title Here');
        
        // Update date with better formatting
        const dateVal = $('#addYear').val();
        if (dateVal) {
            const date = new Date(dateVal);
            const formatted = date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
            $('#displayDate').text(formatted);
        } else {
            $('#displayDate').text('Date Here');
        }
        
        // Update time with better formatting
        const timeVal = $('#addTime').val();
        if (timeVal) {
            const [hours, minutes] = timeVal.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const displayHour = hour % 12 || 12;
            $('#displayTime').html(`<i class="bi bi-clock me-1"></i>${displayHour}:${minutes} ${ampm}`);
        } else {
            $('#displayTime').html('<i class="bi bi-clock me-1"></i>Time');
        }
        
        // Update subject
        const subjectText = $('#addSubject option:selected').text();
        $('#displaySubject').text(subjectText !== 'Select A Subject' ? subjectText : 'Subjects');
        
        // Update description with line breaks preserved
        const text = $('#add_text').val();
        $('#displayText').html(text ? text.replace(/\n/g, '<br>') : 'Description');

        // Update card style based on type
        const type = $('#addType').val();
        const card = $('#announcementPreview');
        card.removeClass('announcement-default announcement-important announcement-homework announcement-noclass');
        
        switch(type) {
            case '1':
                card.addClass('announcement-default');
                break;
            case '2':
                card.addClass('announcement-important');
                break;
            case '3':
                card.addClass('announcement-homework');
                break;
            case '4':
                card.addClass('announcement-noclass');
                break;
        }
    });

    // Enhanced form validation
    $('#announcementForm').on('submit', function(e) {
        e.preventDefault();

        // Remove previous validation states
        $('#announcementForm .form-control, #announcementForm .form-select')
            .removeClass('is-invalid is-valid');

        let valid = true;
        const errors = [];

        // Subject validation
        const subject = $('#addSubject').val();
        if (!subject || $('#addSubject option:selected').text() === 'Select A Subject') {
            $('#addSubject').addClass('is-invalid');
            errors.push('Please select a subject');
            valid = false;
        } else {
            $('#addSubject').addClass('is-valid');
        }

        // Title validation
        const title = $('#addTitle').val().trim();
        if (title.length === 0) {
            $('#addTitle').addClass('is-invalid');
            errors.push('Title is required');
            valid = false;
        } else if (title.length > 500) {
            $('#addTitle').addClass('is-invalid');
            errors.push('Title is too long (max 500 characters)');
            valid = false;
        } else {
            $('#addTitle').addClass('is-valid');
        }

        // Date validation
        const date = $('#addYear').val();
        if (!date) {
            $('#addYear').addClass('is-invalid');
            errors.push('Date is required');
            valid = false;
        } else {
            $('#addYear').addClass('is-valid');
        }

        // Time validation
        const time = $('#addTime').val();
        if (!time) {
            $('#addTime').addClass('is-invalid');
            errors.push('Time is required');
            valid = false;
        } else {
            $('#addTime').addClass('is-valid');
        }

        // Type validation
        const type = $('#addType').val();
        if (!type || $('#addType option:selected').text() === 'Select a type') {
            $('#addType').addClass('is-invalid');
            errors.push('Please select an announcement type');
            valid = false;
        } else {
            $('#addType').addClass('is-valid');
        }

        // Text validation
        const text = $('#add_text').val().trim();
        if (text.length === 0) {
            $('#add_text').addClass('is-invalid');
            errors.push('Announcement text is required');
            valid = false;
        } else if (text.length > 10000) {
            $('#add_text').addClass('is-invalid');
            errors.push('Announcement text is too long (max 10,000 characters)');
            valid = false;
        } else {
            $('#add_text').addClass('is-valid');
        }

        // If validation fails
        if (!valid) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                html: errors.join('<br>'),
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        // Show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.prop('disabled', true)
                 .html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...');

        // Submit via AJAX
        $.ajax({
            url: '../config/add_announcement.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                submitBtn.prop('disabled', false).html(originalText);
                
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Announcement added successfully!',
                        confirmButtonColor: '#198754'
                    }).then(() => {
                        // Clear form
                        $('#announcementForm')[0].reset();
                        $('#announcementForm .form-control, #announcementForm .form-select')
                            .removeClass('is-valid');
                        
                        // Reset preview
                        $('#displayTitle').text('Title Here');
                        $('#displayDate').text('Date Here');
                        $('#displayTime').html('<i class="bi bi-clock me-1"></i>Time');
                        $('#displaySubject').text('Subjects');
                        $('#displayText').text('Description');
                        $('#charCount').text('0');
                        $('#announcementPreview').removeClass('announcement-default announcement-important announcement-homework announcement-noclass');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Failed to add announcement.',
                        confirmButtonColor: '#dc3545'
                    });
                }
            },
            error: function(xhr, status, error) {
                submitBtn.prop('disabled', false).html(originalText);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add announcement. Please try again.',
                    confirmButtonColor: '#dc3545'
                });
                console.error('AJAX Error:', error);
            }
        });
    });

    // Smooth scroll to errors
    $('.form-control, .form-select').on('invalid', function() {
        const firstError = $('.is-invalid').first();
        if (firstError.length) {
            $('html, body').animate({
                scrollTop: firstError.offset().top - 100
            }, 300);
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