<?php
session_start();
if(isset($_SESSION['username'])) {
    // User is already logged in, no need to redirect
} else {
    header("Location: home.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="styleH.css">
    <title>Navigation Bar</title>
</head>
<body>


    <div class="navbar">
        <a href="home.php">Home</a>
          <a href="Logout.php"><?php echo $_SESSION['username'];?></a> 
        <a href="notice.php">Notics</a>
          <a href="class.php">Class</a>
      </div>
      

<div class="main">
    <img src="Welcome.jpg" alt="">
</div>

<footer style="position: fixed;bottom: 0;left: 0;width: 100%;background-color: #333;color: white;text-align: center;padding: 20px;
">
    <p>
        <h4>Get In Touch</h4>
    </p>
    <p>
        Rajshahi University of Engineering and Technology, Talaimari, Rajshahi <br>
        Phone Number: 01611425203
    </p>
    <p>All rights reserved by Abdur Rafiu &copy; 2024</p>
</footer>

</body>
</html>