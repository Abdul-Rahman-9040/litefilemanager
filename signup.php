<?php
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];

        if (isset($_POST['approve'])) {
            // Retrieve user details from signup_requests
            $select_sql = "SELECT * FROM signup_requests WHERE username = '$username'";
            $result = $conn->query($select_sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Insert user details into userregister
                $insert_sql = "INSERT INTO signup_requests (username, email, password, user_type, full_name) 
                                VALUES ('{$row['username']}', '{$row['email']}', '{$row['password']}', '{$row['user_type']}', '{$row['full_name']}')";

                // Delete the user from signup_requests
                $delete_sql = "DELETE FROM signup_requests WHERE username = '$username'";

                if ($conn->query($insert_sql) === TRUE && $conn->query($delete_sql) === TRUE) {
                    echo "User approved and moved to userregister table.";
                } else {
                    echo "Error approving user: " . $conn->error;
                }
            } else {
                echo "User not found in signup_requests.";
            }
        } elseif (isset($_POST['reject'])) {
            // Update the reject column in signup_requests
            $reject_sql = "UPDATE signup_requests SET reject = 1 WHERE username = '$username'";

            if ($conn->query($reject_sql) === TRUE) {
                echo "User rejected.";
            } else {
                echo "Error rejecting user: " . $conn->error;
            }
        }
    } else {
        echo "Invalid username.";
    }
}

$result = $conn->query("SELECT * FROM signup_requests");

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>Username</th>
    <th>Email</th>
    <th>User Type</th>
    <th>Full Name</th>
    <th>Actions</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['username']}</td>
        <td>{$row['email']}</td>
        <td>{$row['user_type']}</td>
        <td>{$row['full_name']}</td>
        <td>
            <form method='post' action=''>
                <input type='hidden' name='username' value='{$row['username']}'>
                <button type='submit' name='approve'>Approve</button>
                <button type='submit' name='reject'>Reject</button>
            </form>
        </td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No signup requests found.";
}

$conn->close();
?>
