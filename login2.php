<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div class="input-box">
            <input type="text" placeholder="Username" name="username" >
            <i class='bx bxs-user-circle'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" name="password" >
            <i class='bx bxs-lock'></i>
        </div>

        <?php
        if(isset($_POST["al"]))
        {
            $_t = $_POST['al'];
            if ($_t == 1) {
                throw new Exception("Your username or password is wrong");
            }
        }
        ?>

        <br>
        <div class="remember-forgot">
            <label><input type="checkbox" name="remember">Remember me</label>
            <a href="#">Forgot Password?</a>
        </div>
        <input type="submit" class="btn" value="Login">
        <div class="registration-link">
            <p>Don't have an account? <a href="registration.html">Registration</a></p>
        </div>
    </form>
</div>
</body>
</html>
