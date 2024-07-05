<?php
// Start session to access session variables
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login2.php");
    exit();
}

// Function to read data from a file and return as an array
function readDataFromFile($filename) {
    // Check if the file exists
    if (file_exists($filename)) {
        // Read the file contents
        $data = file_get_contents($filename);
        // Check if reading was successful
        if ($data !== false) {
            // Return data as an array, trimming extra whitespace
            return explode("\n", trim($data));
        }
    }
    // Return an empty array if the file couldn't be read or doesn't exist
    return [];
}

// Read data from class.txt
$classData = readDataFromFile("class.txt");

// Read data from pdf_filenames.txt
$pdfFiles = readDataFromFile("pdf_filenames.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Page</title>
    <link rel="stylesheet" href="styleC.css">
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="Logout.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a> 
        <a href="notice.php">Notices</a>
        <a href="class.php">Class</a>
    </div>

    <!-- Main content -->
    <main>     
        <div class="card-container">
            <?php
            // Check if both files have data and user is logged in
            if (!empty($classData) && !empty($pdfFiles)) {
                // Display cards for each entry
                foreach ($classData as $key => $value) {
                    if ($key % 2 == 0 && isset($classData[$key + 1]) && isset($pdfFiles[$key / 2])) {
                        // Assuming every two lines in class.txt represent heading and topic
                        $heading = $classData[$key];
                        $topic = $classData[$key + 1];
                        $pdfFilename = $pdfFiles[$key / 2];
                        ?>
                        <!-- Card Set -->
                        <div class="card">
                            <div class="card-header">
                                <?php echo htmlspecialchars($heading); ?>
                            </div>
                            <div class="card-body">
                                <p>Lecture topic <?php echo htmlspecialchars($topic); ?></p>
                            </div>
                            <div class="card-buttons">
                                <!-- Link to view PDF -->
                                <a href="uploads/<?php echo htmlspecialchars($pdfFilename); ?>" target="_blank" class="button">View PDF</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                // No data available to generate cards
                echo "No data available to generate cards.";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>
            <h4>Get In Touch</h4>
        </p>
        <p>
            Rajshahi University of Engineering and Technology, Talaimari, Rajshahi <br>
            Phone Number: 01611425203
        </p>
        <p>All rights reserved by Abdur Rafiu &copy; <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
