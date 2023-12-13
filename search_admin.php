<?php
include("conn.php");

$searchTerm = $_GET['search'];

$sql = "SELECT full_name,username, email FROM userregister WHERE user_type='admin' AND (username LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i=0;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo  "<td>" .$i++. "</td>";
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
