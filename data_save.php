<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $heading = htmlspecialchars($_POST['heading']);
    $topic = htmlspecialchars($_POST['topic']);

    // Save heading and topic to class.txt
    $file = fopen("class.txt", "a"); // Use "w" mode to overwrite existing content
    if ($file) {
        fwrite($file, "$heading\n");
        fwrite($file, "$topic\n");
        fclose($file);
    } else {
        echo "Failed to open class.txt for writing.";
    }

    // Set the directory where you want to store the uploaded PDF files
    $uploadDirectory = "uploads/";

    // Generate a unique filename for the uploaded PDF file
    $originalFileName = $_FILES["pdf"]["name"];
    $originalFileName = str_replace(' ', '_', $originalFileName); // Replace spaces with underscores

    $pdfName = uniqid() . '_' . $originalFileName; // Unique ID + original filename
    $pdfTmpName = $_FILES["pdf"]["tmp_name"];
    $pdfPath = $uploadDirectory . $pdfName;

    // Move the uploaded PDF file to the designated directory with the unique filename
    if (move_uploaded_file($pdfTmpName, $pdfPath)) {
        // Save the unique filename to a text file for future reference
        $file = fopen("pdf_filenames.txt", "a");
        if ($file) {
            fwrite($file, "$pdfName\n");
            fclose($file);
        } else {
            echo "Failed to open pdf_filenames.txt for writing.";
        }
        
        // Redirect back to class.php or any other page
        header("Location: Admin.php");
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
