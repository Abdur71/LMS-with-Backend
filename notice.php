<?php
session_start();
if(isset($_SESSION['username'])) {
    // User is already logged in, no need to redirect
} else {
    header("Location: login2.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleH.css">
    <title>Notice</title>
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="Logout.php"><?php echo $_SESSION['username'];?></a>
        <a href="notice.php">Notice</a>
        <a href="class.php">Class</a>
    </div>
<main>
<div class="notice">Notice</div>
    <ul class="notice-list">
    <?php
if (file_exists('notice.txt')) {
    $file = fopen('notice.txt', 'r');
    while (!feof($file)) {
        $line = fgets($file);
        if (!empty($line)) {
            // Splitting the line into heading and notice
            $parts = explode(": ", $line, 2);
            if (count($parts) == 2) {
                $key = $parts[0];
                $value = $parts[1];
                if ($key == "Heading") {
                    echo "<li class='notice-item'>";
                    echo "<div class='notice-title'>$value</div>";
                } elseif ($key == "Notice") {
                    echo "<div class='notice-content'>$value</div>";
                    echo "</li>";
                }
            }
        }
    }
    fclose($file);
} else {
    echo "<li class='notice-item'><div class='notice-title'>No notices available</div></li>";
}
?>
</ul>
</main>
 
    <footer style="bottom: 0;left: 0;width: 100%;background-color: #333;color: white;text-align: center;padding: 20px;
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