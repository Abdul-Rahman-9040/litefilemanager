<?php
include("conn.php");
// Check if a search term is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Define the SQL query to select only users with user_type='user'
if (!empty($searchTerm)) {
    $sql = "SELECT username, email FROM userregister WHERE user_type='user' AND (username LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";
} else {
    $sql = "SELECT full_name,username, email FROM userregister WHERE user_type='user'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "No results found.";
}

$conn->close();
?>
