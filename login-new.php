<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            function showLoginFailedModal(errorMessage) {
                $('#errorMessage').text(errorMessage); 
                $('#loginFailedModal').modal('show'); 
            }
            $('form[name="loginForm"]').submit(function(e) {
                e.preventDefault(); 
                var username = $('input[name="Username"]').val();
                var password = $('input[name="Password"]').val();
                if (username !== "admin" || password !== "password") {
                    showLoginFailedModal("Incorrect username or password. Please try again."); // Show the modal with error message
                } else {
                    this.submit();
                }
            });
        });
    </script>
</head>
<body>
<div class="wrapper">
    <form name="loginForm" action="login-action.php" method="post">
        <h1>Login</h1>
        <div class="input-box">
            <input type="email" placeholder="Email" required name="Username">
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" required name="Password">
            <i class='bx bxs-lock-alt'></i>
        </div>

        <div class="remember-forgot">
            <label><input type="checkbox" name="checkbox"> Remember me </label>
            <a href="#">Forgot password</a>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        <div class="register-link">
            <p>Don't have an account?<a href="register.php"> Register</a></p>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal" id="loginFailedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login Failed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
