<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="wrapper">
            <form action="register-action.php" method="post">
                <h1>Register</h1>
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