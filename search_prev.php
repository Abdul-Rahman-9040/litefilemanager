<?php
include 'conn.php';

// Fetch all notes from the database
$sql = "SELECT * FROM uploaded_notes";
$result = mysqli_query($conn, $sql);

// Display the notes
echo "<table border='1'>";
echo "<tr><th>User Name</th><th>Scheme</th><th>Uploaded Date</th><th>Semester</th><th>Subject</th><th>Download</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['user_name']}</td>";
    echo "<td>{$row['scheme']}</td>";
    echo "<td>{$row['uploaded_date']}</td>";
    echo "<td>{$row['semester']}</td>";
    echo "<td>{$row['subject']}</td>";
    

    
    // Use urlencode to handle special characters in the filename
    $file_path = urlencode($row['document_path']);
    
    // Add a target attribute to open the link in a new tab/window
    echo "<td><a href='download.php?file={$file_path}' target='_blank'>Download</a></td>";
    echo "</tr>";
}

echo "</table>";
?>
