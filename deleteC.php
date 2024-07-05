<?php
// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// File paths
$class_file_path = "class.txt";
$pdf_filenames_file_path = "pdf_filenames.txt";
$uploads_directory = "uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Sanitize the heading of the notice to delete
    $delete_heading = sanitize_input($_POST["delete"]);

    // Check if file exists
    if (file_exists($class_file_path) && file_exists($pdf_filenames_file_path)) {
        // Read the class file
        $class_lines = file($class_file_path, FILE_IGNORE_NEW_LINES);

        // Read the pdf_filenames file
        $pdf_filenames = file($pdf_filenames_file_path, FILE_IGNORE_NEW_LINES);

        // Open the class file for writing
        $class_file = fopen($class_file_path, "w");

        // Open the pdf_filenames file for writing
        $pdf_filenames_file = fopen($pdf_filenames_file_path, "w");

        // Check if files opened successfully
        if ($class_file && $pdf_filenames_file) {
            $num_lines = count($class_lines);
            $pdf_count = count($pdf_filenames);

            // Iterate through the class lines and pdf_filenames to find and delete the corresponding entry
            for ($i = 0; $i < $num_lines; $i += 2) {
                $heading = $class_lines[$i];
                $topic = isset($class_lines[$i + 1]) ? $class_lines[$i + 1] : '';

                // Check if the heading matches the one to delete
                if ($heading == $delete_heading) {
                    // Delete corresponding pdf file if it exists
                    if ($i / 2 < $pdf_count) {
                        $pdf_filename = $pdf_filenames[$i / 2];
                        if (unlink($uploads_directory . $pdf_filename)) {
                            // Remove entry from pdf_filenames
                            unset($pdf_filenames[$i / 2]);
                        }
                    }
                    continue; // Skip this pair of lines
                }

                // Write the pair of lines to the class file if not deleted
                fwrite($class_file, $heading . PHP_EOL);
                fwrite($class_file, $topic . PHP_EOL);
            }

            // Close the class file
            fclose($class_file);

            // Write the remaining pdf filenames to the pdf_filenames file
            foreach ($pdf_filenames as $pdf_filename) {
                fwrite($pdf_filenames_file, $pdf_filename . PHP_EOL);
            }

            // Close the pdf_filenames file
            fclose($pdf_filenames_file);

            // Redirect back to this page to refresh
            header("Location: Admin.php" );
            exit();
        } else {
            echo "Failed to open files for writing.";
        }
    } else {
        echo "File(s) not found.";
    }
}

// Read the class file
$classData = [];
if (file_exists($class_file_path)) {
    $classData = file($class_file_path, FILE_IGNORE_NEW_LINES);
}

// Read the pdf_filenames file
$pdfFiles = [];
if (file_exists($pdf_filenames_file_path)) {
    $pdfFiles = file($pdf_filenames_file_path, FILE_IGNORE_NEW_LINES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Notices</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: dimgray;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #b16a6a;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php if (!empty($classData)) : ?>
            <h1>Delete Notices</h1>
            <ul>
                <?php for ($i = 0; $i < count($classData); $i += 2) : ?>
                    <?php $heading = isset($classData[$i]) ? htmlspecialchars($classData[$i]) : ''; ?>
                    <li>
                        <label>
                            <input type="radio" name="delete" value="<?php echo $heading; ?>">
                            <?php echo $heading; ?>
                        </label>
                    </li>
                <?php endfor; ?>
            </ul>
            <button type="submit">Delete Selected</button>
        <?php else : ?>
            <p>No notices available.</p>
        <?php endif; ?>
    </form>
</body>
</html>
