<?php
include 'conn.php';

if (isset($_GET['file'])) {
    $file_path = urldecode($_GET['file']);
    
    // Validate the file path here if needed

    // Set the appropriate headers for a download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_path));
    header('Content-Length: ' . filesize($file_path));

    // Read the file and output it to the browser
    readfile($file_path);
    exit;
} else {
    // Handle the case where the file parameter is not provided
    echo "Invalid file request.";
}
?>
