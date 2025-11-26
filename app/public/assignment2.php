<?php
// Define the directory where files will be stored
// __DIR__ gives the current directory of this script.
$uploadDir = __DIR__ . '/uploads/';

// Create the folder if it doesn't exist (just in case)
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$message = '';

// Handle File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Check if a file was actually uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        
        $tmpName = $_FILES['file']['tmp_name'];
        $name = basename($_FILES['file']['name']);
        
        // Move the file from the temporary location to our uploads folder
        if (move_uploaded_file($tmpName, $uploadDir . $name)) {
            $message = "<div class='alert alert-success'>File '$name' uploaded successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to move uploaded file. Check permissions.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>No file selected or upload error occurred.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2 Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-Zenh87qX5JnK2J10vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="pt-5">Upload Form</h1>
    
    <?php echo $message; ?>

    <!-- IMPORTANT: enctype="multipart/form-data" is required for file uploads -->
    <form method="POST" action="assignment2.php" enctype="multipart/form-data">
        <label>Your name:</label><br>
        <input type="text" name="name" placeholder="Full name" class="form-control w-50"><br>

        <label>File:</label><br>
        <input type="file" name="file" class="form-control w-50"><br><br>

        <input type="submit" value="Submit" class="btn btn-primary">
    </form>

    <hr>

    <h2 class="pt-3">Uploaded Files</h2>
    <div class="list-group w-50">
        <?php
        // Get all files in the uploads directory
        // scandir returns an array of files
        $files = scandir($uploadDir);

        // Check if there are files (scandir returns . and .. so count must be > 2)
        $hasFiles = false;

        foreach ($files as $file) {
            // Skip current directory (.) and parent directory (..)
            if ($file !== '.' && $file !== '..') {
                $hasFiles = true;
                // Create a link to the file. 
                // Note: We link to 'uploads/filename' relative to the public folder.
                echo "<a href='uploads/" . htmlspecialchars($file) . "' class='list-group-item list-group-item-action' target='_blank'>" . htmlspecialchars($file) . "</a>";
            }
        }

        if (!$hasFiles) {
            echo "<p class='text-muted'>No files uploaded yet.</p>";
        }
        ?>
    </div>

</div>
</body>
</html>