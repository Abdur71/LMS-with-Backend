<?php
// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// File path
$file_path = "notice.txt";

// Check if form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Sanitize the heading of the notice to delete
    $delete_heading = sanitize_input($_POST["delete"]);

    // Read the file
    $lines = file($file_path, FILE_IGNORE_NEW_LINES);

    // Open the file for writing
    $file = fopen($file_path, "w");

    // Flag to track if the notice is found and deleted
    $notice_deleted = false;

    // Iterate through the lines and write them back excluding the selected notice
    foreach ($lines as $line) {
        // Check if the line contains the heading of the notice to delete
        if (strpos($line, "Heading: ") !== false && strpos($line, $delete_heading) !== false) {
            // Skip this line and the next line (which contains the notice content)
            $notice_deleted = true;
            continue;
        }

        // Write the line to the file if the notice is not deleted
        if (!$notice_deleted) {
            fwrite($file, $line . PHP_EOL);
        }

        // Reset the flag if a notice has been deleted
        if ($notice_deleted) {
            $notice_deleted = false;
        }
    }

    // Close the file
    fclose($file);

    // Redirect back to Admin.html after deletion
    header("Location: Admin.php");
    exit();
}

// Read the file
$notices = file($file_path, FILE_IGNORE_NEW_LINES);
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
        <?php if (!empty($notices)) : ?>
            <h1>Delete Notices</h1>
            <ul>
                <?php foreach ($notices as $index => $notice) : ?>
                    <?php if (strpos($notice, "Heading: ") !== false) : ?>
                        <?php $heading = str_replace("Heading: ", "", $notice); ?>
                        <li>
                            <label>
                                <input type="radio" name="delete" value="<?php echo $heading; ?>">
                                <?php echo $heading; ?>
                            </label>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <button type="submit">Delete Selected</button>
        <?php else : ?>
            <p>No notices available.</p>
        <?php endif; ?>
    </form>
</body>
</html>
