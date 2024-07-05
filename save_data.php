<?php
// Ensure the script is accessed through a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $heading = isset($_POST['heading']) ? htmlspecialchars($_POST['heading']) : '';
    $notice = isset($_POST['notice']) ? htmlspecialchars($_POST['notice']) : '';

    // Proceed only if both heading and notice are not empty
    if (!empty($heading) && !empty($notice)) {
        // Open the file for appending
        $file = fopen("notice.txt", "a");

        // Write the data to the file
        fwrite($file, "Heading: $heading\n");
        fwrite($file, "Notice: $notice\n\n");

        // Close the file
        fclose($file);
    }
}

// Redirect back to the HTML form
header("Location: Admin.php");
exit();
?>
