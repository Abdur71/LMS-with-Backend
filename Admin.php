<?php
session_start();
if(isset($_SESSION['username'])) {
    // User is already logged in, no need to redirect
} else {
    header("Location: AdminLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="Admin.php" onclick="loadContent('index')">Dashboard</a></li>
            <li><a href="#" onclick="toggleNoticeSidebar()">Notice</a></li>
            <li><a href="#" onclick="toggleClassSidebar()"> Class</a></li>
        </ul>
    </div>
    <button class="login-button"><a href="AdminLogout.php">Logout</a></button>
    <div class="content">
        
        <div class="header">
            <h1>Dashboard</h1>
        </div>
        <div class="info">
            <h3>Welcome to the Admin Panel.</h3>
            <h4>Please Follow This Rules</h4>
            <ol>
                <li> Robust access control mechanisms
                <li>Data encryption and secure authentication</li> 
                <li>Comprehensive audit trails</li>
                <li>Regular backups</li>
                <li>Don't share data with anyone</li>
            </ol>

        </div>
    </div>

    <!-- Notice Sidebar -->
    <div class="sidebar" id="notice-sidebar" style="display: none;">
        <h2>Notice Sidebar</h2>
        <ul>
            <li><a href="#" onclick="loadContent('notice.html')">Add Notice</a></li>
            <li><a href="#" onclick="loadContent('delete.php')">Delete Notice</a></li>
            <!-- Add more links as needed -->
        </ul>
    </div>

       <!-- Notice Sidebar -->
       <div class="sidebar" id="class-sidebar" style="display: none;">
        <h2>Class Sidebar</h2>
        <ul>
            <li><a href="#" onclick="loadContent('class.html')">Add Class</a></li>
            <li><a href="#" onclick="loadContent('deleteC.php')">Delete class</a></li>
            <!-- Add more links as needed -->
        </ul>
    </div>

    <script src="script.js"></script>
    <script>
        function loadContent(page) {
            var extension = page.includes('.') ? '' : '.php'; // Check if the page already has an extension
            // Fetch the content of the specified page
            fetch(page.toLowerCase() + extension)
                .then(response => response.text())
                .then(data => {
                    // Replace the content of the main area with the loaded page
                    document.querySelector('.content').innerHTML = data;
                })
                .catch(error => console.error('Error fetching page:', error));
        }

        function toggleNoticeSidebar() {
            var sidebar = document.getElementById('notice-sidebar');
            if (sidebar.style.display === 'none') {
                sidebar.style.display = 'block';
            } else {
                sidebar.style.display = 'none';
            }
        }

        function toggleClassSidebar() {
            var sidebar = document.getElementById('class-sidebar');
            if (sidebar.style.display === 'none') {
                sidebar.style.display = 'block';
            } else {
                sidebar.style.display = 'none';
            }
        }
    </script>
</body>
</html>
