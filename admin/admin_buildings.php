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
    
    <title>Way2Class - Availability Management</title>
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
    
<!-- VVVV -->
    <!-- <div class="main-content">
            <h1> Buildings and Room Management </h1>
            <div class="d-flex">
                <div class="container-fluid">
                    <div class="card mt-3 shadow mb-5 p-0 bg-body-tertiary rounded small">
                        <div class="card-header">
                             <h1> Buildings Availability Option</h1>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="acco-buildings">
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mainBuilding" aria-expanded="true" aria-controls="mainBuilding">
                                       
                                       </button> 
                                    </h1>
                                    <div id="mainBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                            <div class="d-flex">

                                            </div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#annexBuilding" aria-expanded="false" aria-controls="annexBuilding">
                                          Annex Building
                                       </button> 
                                    </h1>
                                    <div id="annexBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                            <div class="d-flex">
                                                
                                            </div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#htmdBuilding" aria-expanded="true" aria-controls="htmdBuilding">
                                         HTMD Building
                                       </button> 
                                    </h1>
                                    <div id="htmdBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                            <div class="d-flex">
                                                
                                            </div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#herriBuilding" aria-expanded="true" aria-controls="herriBuilding">
                                            Herritage
                                       </button> 
                                    </h1>
                                    <div id="herriBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                            <div class="d-flex">
                                                
                                            </div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#multiBuilding" aria-expanded="true" aria-controls="multiBuilding">
                                         Multi-purpose Building
                                       </button> 
                                    </h1>
                                    <div id="multiBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                            <div class="d-flex">
                                                
                                            </div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jegBuilding" aria-expanded="true" aria-controls="jegBuilding">
                                          JEG Building
                                       </button> 
                                    </h1>
                                    <div id="jegBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                            <div class="d-flex">
                                                
                                            </div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                            <div class="d-flex"></div>
                                        </div>
                                    </div>
                              </div>
                                <div class="accordion-item">
                                    <h1 class="accordion-header">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nstpBuilding" aria-expanded="true" aria-controls="nstpBuilding">
                                         Other Buildings
                                       </button> 
                                    </h1>
                                    <div id="nstpBuilding" class="accordion-collapse collapse" data-bs-parent="#acco-buildings"> 
                                        <div class="accordion-body">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    -->
<!-- ^^^  -->
            
<div class="main-content">
        <h1>Buildings Management </h1>
        <div class="card mt-3 shadow mb-5 p-0 bg-body-tertiary rounded small">
            <div class="card-header ">
               <h2> Building and Rooms Availability </h2>
            </div>
            <div class="card-body">
                <div class="accordion" id="buildingsAccordion">

                 </div>
            </div>
        </div>
</div>

<!-- Room Alert Model -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    
    
</div>

<script>
    // Creates a template toast pop up for availability buttons.
    function showToast(message, type = 'success') {
        const toastId = 'toast' + Date.now();
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        $('.toast-container').append(toastHtml);
        const toastEl = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
        toast.show();
        toastEl.addEventListener('hidden.bs.toast', function () {
            toastEl.remove();
        });
    }

    $(document).ready(function() {
        // Create accordion on each entity
        $.getJSON('../config/fetchBuildingsRooms.php', function(buildings) {
            let html = '';
            buildings.forEach(function(building) {
                let collapseId = 'collapse' + building.building_number;
                let isAvailable = building.avail_id == 1;
                html += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading${building.building_number}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">
                            ${building.name}
                            <span class="ms-3">
                                <input type="checkbox" class="form-check-input building-toggle" data-id="${building.building_number}" ${isAvailable ? 'checked' : ''}>
                                <span class="building-status badge ${isAvailable ? 'bg-success' : 'bg-danger'}">${isAvailable ? 'Available' : 'Unavailable'}</span>
                            </span>
                        </button>
                    </h2>
                    <div id="${collapseId}" class="accordion-collapse collapse" aria-labelledby="heading${building.building_number}" data-bs-parent="#buildingsAccordion">
                        <div class="accordion-body">
                            <div class="accordion" id="floorsAccordion${building.building_number}">
                `;
                
                //  Populates the nested accordion for each floor
                building.floors.forEach(function(floor) {
                    let floorCollapseId = `floorCollapse${building.building_number}_${floor.floor_id}`;
                    html += `
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="floorHeading${building.building_number}_${floor.floor_id}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${floorCollapseId}" aria-expanded="false" aria-controls="${floorCollapseId}">
                                Floor ${floor.floor_number}
                            </button>
                        </h2>
                        <div id="${floorCollapseId}" class="accordion-collapse collapse" aria-labelledby="floorHeading${building.building_number}_${floor.floor_id}" data-bs-parent="#floorsAccordion${building.building_number}">
                            <div class="accordion-body">
                                <ul class="list-group">
                    `;
                    floor.rooms.forEach(function(room) {
                        let isOccupied = room.avail_id == 2;
                        html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ${room.type}
                                <span>
                                    <input type="checkbox" class="form-check-input occupied-toggle" data-id="${room.room_id}" ${isOccupied ? 'checked' : ''}>
                                    <span class="occupied-status badge ${isOccupied ? 'bg-warning text-dark' : 'bg-secondary'}">${isOccupied ? 'Occupied' : 'Unoccupied'}</span>
                                </span>
                            </li>
                        `;
                    });
                    html += `
                                </ul>
                            </div>
                        </div>
                    </div>
                    `;
                });

                html += `
                            </div>
                        </div>
                    </div>
                </div>
                `;
            });

            $('#buildingsAccordion').html(html);

            // Toast pop up for buildings.
            $('#buildingsAccordion').on('change', '.building-toggle', function() {
                var id = $(this).data('id'); 
                var avail_id = $(this).is(':checked') ? 1 : 0;
                var statusSpan = $(this).closest('span').find('.building-status');
                var buildingName = $(this).closest('button').contents().get(0).nodeValue.trim();
                var actionText = avail_id == 1 ? 'Available' : 'Unavailable';

                statusSpan.text(actionText)
                    .removeClass('bg-success bg-danger')
                    .addClass(avail_id == 1 ? 'bg-success' : 'bg-danger');

                // ✅ FIX: send correct field name "building_number"
                $.post('../config/updateBuildingAvailability.php', { building_number: id, avail_id: avail_id }, function(response) {
                    showToast(`${buildingName} has been updated to ${actionText}`, response.success ? 'success' : 'danger');
                }, 'json');
            });

            // Toast popup for rooms.
            $('#buildingsAccordion').on('change', '.occupied-toggle', function() {
                var id = $(this).data('id');
                var avail_id = $(this).is(':checked') ? 2 : 3;
                var statusSpan = $(this).closest('span').find('.occupied-status');
                var roomName = $(this).closest('li').contents().get(0).nodeValue.trim();
                var actionText = avail_id == 2 ? 'Occupied' : 'Unoccupied';

                statusSpan.text(actionText)
                    .removeClass('bg-warning bg-secondary text-dark')
                    .addClass(avail_id == 2 ? 'bg-warning text-dark' : 'bg-secondary');

                $.post('../config/updateRoomAvailability.php', { room_id: id, avail_id: avail_id }, function(response) {
                    showToast(`${roomName} has been updated to ${actionText}`, response.success ? 'success' : 'danger');
                }, 'json');
            });
        });
    });

    // Logout Confirmation
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

</script>
</body>
</html>