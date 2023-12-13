<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in (based on the session).
    if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
        $user_name = $_SESSION['username']; // Retrieve the user's username from the session.

        // Automatically generate the current date.
        $date = date("Y-m-d");

        // Extract data from the form
        $scheme = $_POST['scheme'];
        $semester = $_POST['semester'];
        $subject = $_POST['subject'];
        $internal= $_POST['internal'];
        // Define the directory where you want to store the uploaded files.
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/project/uploadinternals/';

        // Construct the full path to the file using the uploaded file's name.
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            // File was successfully uploaded, now insert the information into the database.
            $sql = "INSERT INTO uploaded_internals(user_name,scheme,uploaded_date,semester,subject,internal,document_path) VALUES (?, ?, ?, ?, ?, ?,?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssss", $user_name, $scheme, $date, $semester, $subject, $internal, $uploadFile);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    echo '<script>alert("Internals Question paper uploaded successfully!"); window.location.href = "admin_dashboard.php";</script>';
                    exit;
                } else {
                    echo "Error uploading notes to the database.";
                }
            } else {
                echo "Error preparing the SQL statement.";
            }
        }
    } else {
        echo "User is not logged in. Please log in first.";
    }
}
?>
