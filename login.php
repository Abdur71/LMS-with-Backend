<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "login_database";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";

    $result = $conn->query($query);

    if($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        header("Location: login2.php?al=1");
        exit();
    }
}
?>
