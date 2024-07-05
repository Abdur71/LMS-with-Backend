<?php
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $host = "localhost";
    $dbusername = "root";  
    $dbpassword = "";
    $dbname = "login_database";
    
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO login (first_name, last_name, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first_name, $last_name, $username, $password);
        $stmt->execute();
        header("Location: login2.php");
        $stmt->close();
        $conn->close();
    }
?>
