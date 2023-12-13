<?php
session_start(); // Ensure session is started

$loginUsername = $_SESSION['username'];

// Check if the user is logged in
if (empty($loginUsername)) {
    echo "User not logged in.";
    exit();
}

$id = $_GET['id'];
$user_name = $_GET['user_name'];

// Check if the logged-in user matches the provided user_name
if ($loginUsername == $user_name) {
    // Assuming you have a database connection
    include("conn.php");

    // Check if id and table name parameters are set in the URL
    if (isset($_GET['id']) && isset($_GET['table'])) {
        $idToDelete = $_GET['id'];
        $tableToDeleteFrom = $_GET['table'];

        // Define the allowed tables
        $allowedTables = ["uploaded_notes", "uploaded_internals", "uploaded_prev"];

        // Check if the provided table is in the allowed tables
        if (in_array($tableToDeleteFrom, $allowedTables)) {
            // Construct a delete query for the specific row in the table
            $deleteQuery = "DELETE FROM $tableToDeleteFrom WHERE id = $idToDelete";

            // Execute the delete query
            $result = $conn->query($deleteQuery);

            // Check if deletion was successful
            if ($result === FALSE) {
                echo "Error deleting from table $tableToDeleteFrom: " . $conn->error;
                exit; // Exit if there's an error
            }

            $message = "Deletion successful for ID $idToDelete in table $tableToDeleteFrom.";
        } else {
            $message = "Table $tableToDeleteFrom is not allowed for deletion.";
        }

        // Close the database connection
        if ($conn !== null) {
            $conn->close();
        }

        // Display message in alert and redirect to dashboard
        echo "<script>alert('$message'); window.location.href='admin_dashboard.php';</script>";
        exit();
    } else {
        echo "ID or table name not provided for deletion.";
    }
} else {
    echo '<script>alert("User not authorized to delete."); window.location.href = "admin_dashboard.php";</script>';
}
?>
