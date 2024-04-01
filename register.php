<?php 
include("config.php");
include("firebaseRDB.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <form action="register-action.php" method="post">
                <h1>Register</h1>
                <?php
                    if(isset($_SESSION['wrong'])){?>
                        <div class="alert alert-danger" style="width: 90%; border-radius: 10px;" role="alert">
                        <?php echo $_SESSION['wrong'];?>
                        </div>
                    <?php }
                    unset($_SESSION['wrong']);?>
            <div class="input-box">
                <input type="text" placeholder="Username" required name="Username"> 
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Your email" required name="Email"> 
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required name="Password">
                <i class='bx bxs-lock-alt'></i> 
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="password"> I agree the terms &#38 conditions </label>
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="register-link">
                <p>Already have an account?<a href="login.php"> Login</a></p>
            </div>
            </form>
        </div>
    </body>
</html>