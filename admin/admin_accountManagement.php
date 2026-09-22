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

    <title>Way2Class - Account Management</title>
    <style>
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
        
        .modal.show {
            display: block !important;
        }
    </style>
</head>
<body>
    
    <!-- SIDEBAR START-->
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
            <h1>Account Management</h1>
            <div class="card mt-3 shadow mb-5 p-3 bg-body-tertiary rounded small">
                <div class="card-title mx-4 d-flex align-content-center justify-content-between"> 
                    <h2>User Accounts: List</h2>
                    <button class="btn btn-success mb-3 mt-1" id="addAccount">Add New Account</button> 
                </div>
                <div class="card-body">
                    <table class="table table-responsive order-column" id="accountList">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Role</th>
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
                <form id="addForm">
                    <div class="modal-header">
                        <h3 class="modal-title" id="addModalLabel">Add New Account</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_userid" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="add_userid" name="user_Id" required>
                            <div class="invalid-feedback">Please enter a valid User ID (alphanumeric and hyphens only)</div>
                        </div>
                        <div class="mb-3">
                            <label for="add_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="add_email" name="email" required>
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>
                        <div class="mb-3">
                            <label for="add_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="add_password" name="password" required>
                            <div class="invalid-feedback">Password must be at least 8 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="add_role" class="form-label">Role</label>
                            <select class="form-select" id="add_role" name="role" required>
                                <option value="">Select a role</option>
                                <option value="admin">Admin</option>
                                <option value="student">Student</option>
                                <option value="faculty">Faculty</option>
                            </select>
                            <div class="invalid-feedback">Please select a role</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Account</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> 
            <form id="editForm">  
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="editModalLabel">Edit Account</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_original_userid" name="original_user_id">
                        
                        <div class="mb-3">
                            <label for="edit_userid" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="edit_userid" name="new_user_id" required>
                            <div class="invalid-feedback">Please enter a valid User ID (alphanumeric and hyphens only)</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="edit_password" name="password" placeholder="Leave blank to keep current password">
                            <div class="invalid-feedback">Password must be at least 8 characters if provided</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-select" id="edit_role" name="role" required>
                                <option value="">Select a role</option>
                                <option value="admin">Admin</option>
                                <option value="student">Student</option>
                                <option value="faculty">Faculty</option>
                            </select>
                            <div class="invalid-feedback">Please select a role</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        console.log('Page loaded');

        // Initialize DataTable
        var table = $('#accountList').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            responsive: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: '../config/fetchAccounts.php',
                type: 'POST',
                dataSrc: ''
            },
            columns: [
                {data: 'user_id', width: '150px'},
                {data: 'email', width: '250px'},
                {data: 'role', width: '100px'},
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    width: '150px',
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary btn-sm editBtn" data-id="' + row.user_id + '" data-email="' + row.email + '" data-role="' + row.role + '">Edit</button> ' +
                               '<button class="btn btn-danger btn-sm deleteBtn" data-id="' + row.user_id + '">Delete</button>';
                    }
                }
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            pageLength: 10
        });

        // Show Add Modal
        $('#addAccount').click(function(e) {
            e.preventDefault();
            $('#addForm')[0].reset();
            $('#addForm .form-control, #addForm .form-select').removeClass('is-invalid is-valid');
            var modal = new bootstrap.Modal($('#addModal')[0]);
            modal.show();
        });

        // Add Form Submit
        $('#addForm').submit(function(e) {
            e.preventDefault();
            
            $(this).find('.form-control, .form-select').removeClass('is-invalid is-valid');
            
            var valid = true;
            
            // Validate User ID
            var userId = $('#add_userid').val().trim();
            if (!userId || !/^[A-Za-z0-9\-]+$/.test(userId)) {
                $('#add_userid').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_userid').addClass('is-valid');
            }
            
            // Validate Email
            var email = $('#add_email').val().trim();
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                $('#add_email').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_email').addClass('is-valid');
            }
            
            // Validate Password
            var password = $('#add_password').val();
            if (password.length < 8) {
                $('#add_password').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_password').addClass('is-valid');
            }
            
            // Validate Role
            var role = $('#add_role').val();
            if (!role) {
                $('#add_role').addClass('is-invalid');
                valid = false;
            } else {
                $('#add_role').addClass('is-valid');
            }
            
            if (!valid) return false;
            
            $.ajax({
                url: '../config/addAccount.php',
                type: 'POST',
                data: {
                    user_id: userId,
                    email: email,
                    password: password,
                    role: role
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        });
                        bootstrap.Modal.getInstance($('#addModal')[0]).hide();
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Server error occurred'
                    });
                }
            });
        });

        // Show Edit Modal
        $('#accountList').on('click', '.editBtn', function(e) {
            e.preventDefault();
            
            var userId = $(this).data('id');
            var email = $(this).data('email');
            var role = $(this).data('role');
            
            $('#edit_original_userid').val(userId);
            $('#edit_userid').val(userId);
            $('#edit_email').val(email);
            $('#edit_password').val('');
            $('#edit_role').val(role);
            
            $('#editForm .form-control, #editForm .form-select').removeClass('is-invalid is-valid');
            
            var modal = new bootstrap.Modal($('#editModal')[0]);
            modal.show();
        });

        // Edit Form Submit
        $('#editForm').submit(function(e) {
            e.preventDefault();
            
            $(this).find('.form-control, .form-select').removeClass('is-invalid is-valid');
            
            var valid = true;
            
            // Validate User ID
            var newUserId = $('#edit_userid').val().trim();
            if (!newUserId || !/^[A-Za-z0-9\-]+$/.test(newUserId)) {
                $('#edit_userid').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_userid').addClass('is-valid');
            }
            
            // Validate Email
            var email = $('#edit_email').val().trim();
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                $('#edit_email').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_email').addClass('is-valid');
            }
            
            // Validate Password (optional)
            var password = $('#edit_password').val();
            if (password.length > 0 && password.length < 8) {
                $('#edit_password').addClass('is-invalid');
                valid = false;
            } else if (password.length >= 8) {
                $('#edit_password').addClass('is-valid');
            }
            
            // Validate Role
            var role = $('#edit_role').val();
            if (!role) {
                $('#edit_role').addClass('is-invalid');
                valid = false;
            } else {
                $('#edit_role').addClass('is-valid');
            }
            
            if (!valid) return false;
            
            var originalId = $('#edit_original_userid').val();
            var data = {
                original_user_id: originalId,
                new_user_id: newUserId,
                email: email,
                role: role
            };
            
            if (password) {
                data.password = password;
            }
            
            console.log('Sending update data:', data);
            
            $.ajax({
                url: '../config/updateAccount.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log('Update response:', response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        });
                        bootstrap.Modal.getInstance($('#editModal')[0]).hide();
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Server error occurred'
                    });
                }
            });
        });

        // Delete Account
        $('#accountList').on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'Delete this account?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../config/deleteAccount.php',
                        type: 'POST',
                        data: {user_id: userId},
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message
                                });
                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            console.error('AJAX Error:', xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Server error occurred'
                            });
                        }
                    });
                }
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
</body>
</html>