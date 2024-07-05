<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username and password
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Verify username and password
    if ($username == 'admin' && $password == 'admin') {
        // Authentication successful, set session variables
        $_SESSION['username'] = $username;

        // Redirect to Admin.php
        header("Location: Admin.php");
        exit();
    } else {
        // Invalid credentials, redirect back to login page
        header("Location: AdminLogin.php");
        exit();
    }
} else {
    // If not a POST request, redirect to login page
    
    exit();
}
?>
