<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/sweetalert2.min.css">
    <link rel="stylesheet" href="../Assets/animate.min.css">
    <title>Way2Class</title>
    <style>
        html {
            overflow-x: hidden;
        }

        body {
                background-color: rgb(255, 255, 255);
                overflow-x: hidden;
            }

        .custom-btn {
                border-color: rgb(40, 72, 153); 
                color: rgb(40, 72, 153); 
                --bs-btn-hover-color: #ffffff;
                --bs-btn-hover-bg: rgb(40, 72, 153);
                --bs-btn-hover-border-color:rgb(40, 72, 153);
                --bs-btn-focus-shadow-rgb: 13, 110, 253;
                --bs-btn-active-color: rgb(40, 72, 153);
                --bs-btn-active-bg: rgb(40, 72, 153);
                --bs-btn-active-border-color: rgb(40, 72, 153);
                --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            }
        
        

    </style>
</head>
<body style="background-image: url('/CAMPUS_NAVIGATION_SYSTEM/IMG/WHITE-BG.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <div class="animate__animated animate__fadeIn" style="text-align: center;">
        <h1><img src="../IMG/Way2Class-LOGO.png" alt="" style="width: 25%; height: auto; margin-top: 50px;" class="position-absolute top-0 start-50 translate-middle"></h1>
    </div>
    <form id="form">       
        <div class="container"> <!-- Make auto-responsive-->
            <div class="card position-absolute top-50 start-50 translate-middle animate__animated animate__fadeIn" style="width: 35%; height: 66%; border-radius: 10px; border-radius: 10px; box-shadow: 10px 10px 10px 3px">
                <h1 style="text-align: center; background-color: rgb(40, 72, 153); padding-right: 50px; height: 80px;" class="card-header h1 fw-bold text-white"> <img src="/LIBRARY_SYSTEM_MANAGEMENT/IMAGES/login_icon.png" alt="" style="height: 55px; width: 60px;">  LOGIN</h1>
                    <div class="card-body d-flex flex-column mb-3 shadow">
                        <form action="" method='post'>
                            <label for="userID" class="form-label fw-bold">User ID:</label>
                            <input type="text" id="userID" name='userID' placeholder="Enter User ID" class="form-control mb-3" style="width: 100%; border-radius: 10px;"> 
                        
                            <label for="password" class='form-label fw-bold'>Password: </label>
                            <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control mb-3" style="width: 100%; border-radius: 10px;">
                            <div class="d-flex flex-row mb-3">
                                <input style="position: relative; left: 10px;" type="checkbox" class="form-check-input p-2" id="checkboxNoLabel" value="" aria-label="...">
                                <label for="" class="p-2" style="position: relative; left: 10px; bottom: 8px;">Show password</label>

                                <a href="student_register.php" style="position: relative; left: 130px;">Forgot Password?</a>
                            </div>
                            
                            <div class='text-center'>
                                <button type="submit" class="btn w-50 custom-btn" id="btn_login" name="btn_login" style="border-radius: 10px; width: 40%; margin-top: 3px;">LOGIN</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div> 
    </form>        

    <script src="../Assets/jquery-3.7.1.min.js"></script>
    <script src="../Assets/sweetalert2.all.min.js"></script>

    <script>
        $('#form').on("submit", function(e){
            e.preventDefault();
            
            $.ajax({
                url: "../config/LOGIN.php", 
                type: "POST", 
                data: $(this).serialize(),
                dataType: "json", 
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Login Successful",
                            text: "Redirecting to your dashboard..", 
                            timer: 1200, 
                            timerProgressBar: true,
                            showConfirmButton: false

                        });
                        setTimeout(() => {
                            if (response.role === "admin"){
                                window.location.href = "../admin/admin_dashboard.php"; 
                            } else if (response.role === "teacher"){
                                window.location.href = "../teacher/teacher_dashboard.php";
                            } else {
                                window.location.href = "../pages/dashboard.php";
                            }
                        }, 1200);
                    } else {
                        Swal.fire({
                            icon: "error", 
                            title: "Login Failed", 
                            text: response.message,
                            timer: 2000, 
                            timerProgressBar: true,
                            showConfirmButton: true 
                        });
                    }
                }, 
                
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "AJAX Error", 
                        text: "Something went wrong: " + error 

                    });
                }
            })
        })

        const showpass = $('#checkboxNoLabel');
        const pass = $('#password');
        
        showpass.on('click', function() {

            if (showpass.prop('checked')){
                pass.attr('type', 'text');
            } else {
                pass.attr('type', 'password');
            };
            
        });

    </script>
</body>
</html>