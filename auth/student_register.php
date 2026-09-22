
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/animate.min.css">k
    <script src="../Assets/js/bootstrap.bundle.min.js" ></script>
    <title>Way2Class</title>
    <style>
        html, body {
            overflow-x: hidden;
        }
    </style>
</head>
<body style="background-image: url('/CAMPUS_NAVIGATION_SYSTEM/IMG/WHITE-BG.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;   "> 
    <div class="animate__animated animate__fadeIn" style="text-align: center;">
        <h1><img src="../IMG/Way2Class-LOGO.png" alt="" style="width: 25%; height: auto; margin-top: 50px;" class="position-absolute top-0 start-50 translate-middle"></h1>
    </div>  
    <div class="container my-5" style="width: 70%;" >
        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="card justify-contert-center animate__animated animate__fadeIn" style="box-shadow: 10px 10px 10px 5px; border-radius: 15px; margin-top: 45px;"> 
                    <h1 style="text-align: center; padding-right: 40px; background-color: rgb(40, 72, 153);" class="card-header text-white h1 fw-bold"> <img src="/LIBRARY_SYSTEM_MANAGEMENT/IMAGES/login_icon.png" alt="" style="height: 55px; width: 60px;">REQUEST</h1>
                    <div class="card-body">
                        <form method='POST' id="requestForm">
                            
                            <div>
                                <label for="regemail" class="form-label fw-bold">Email:</label>
                                <input type="email" id="regemail" name='regemail' placeholder="Enter Valid Email" class="form-control mb-2" style="width: 100%; height: 65%; border-radius: 10px;">
                            </div>

                            <div class='text-center mb-3'>
                                Already have an account? <a href="../auth/mylogin.php">Login</a>
                            </div>

                            <div class='text-center'>
                                <button type='submit' class="btn btn-outline-success w-50 mb-3" id="btn_register" name="btn_register" style="margin-top: 10px; border-radius: 10px; text-align: center;">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).ready(function() {
    $('#requestForm').on('submit', function(e) {
        e.preventDefault(); // stop normal form submission

        $.ajax({
            url: '../config/REGISTER.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    icon: response.status,
                    title: response.status === 'success' ? 'Success!' :
                           response.status === 'warning' ? 'Notice' : 'Error',
                    text: response.message,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (response.status === 'success') {
                        window.location.href = '../auth/mylogin.php';
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong: ' + error
                });
            }
        });
    });
});


</script>

</body>
</html>
