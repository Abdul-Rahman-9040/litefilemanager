<?php
session_start();



include("conn.php");

// Process approval or rejection if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $action = $_POST["action"]; // "approve" or "reject"

    if ($action === "approve") {
        // Get user details
        $get_user_query = "SELECT * FROM userregister WHERE id = $user_id";
        $user_result = mysqli_query($conn, $get_user_query);
        $user_data = mysqli_fetch_assoc($user_result);

        // Insert user details into the registered table
        $insert_query = "INSERT INTO registered (full_name, username, email, password, user_type, reject) 
        VALUES ('{$user_data['full_name']}', '{$user_data['username']}', '{$user_data['email']}', '{$user_data['password']}', '{$user_data['user_type']}', '{$user_data['reject']}')";


        if (mysqli_query($conn, $insert_query)) {
            // Update approval status in the userregister table
            $update_query = "UPDATE userregister SET approval_status = 'approved' WHERE id = $user_id";
            mysqli_query($conn, $update_query);

            echo "<script>
                    alert('User approved and added to registered table.');
                    window.location.href = 'admin_approval.php';
                 </script>";
        } else {
            echo "Error inserting user details: " . mysqli_error($conn);
        }
    } elseif ($action === "reject") {
        // Update approval status in the userregister table
        $update_query = "UPDATE userregister SET approval_status = 'rejected' WHERE id = $user_id";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>
                    alert('User rejected.');
                    window.location.href = 'admin_approval.php';
                 </script>";
        } else {
            echo "Error updating approval status: " . mysqli_error($conn);
        }
    }
}

// Fetch pending user registrations for approval
$query_pending_users = "SELECT id, full_name, username FROM userregister WHERE approval_status = 'pending'";
$result_pending_users = mysqli_query($conn, $query_pending_users);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="approval-container">
        <h2>User Approval</h2>

        <h3>Pending Approvals</h3>
        <?php
        // Display pending user registrations in a form
        while ($row = mysqli_fetch_assoc($result_pending_users)) {
            echo "<form method='post' action='admin_approval.php'>";
            echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
            echo "<p>Name: " . $row['full_name'] . "<br>Username: " . $row['username'] . "</p>";
            echo "<button type='submit' name='action' value='approve'>Approve</button>";
            echo "<button type='submit' name='action' value='reject'>Reject</button>";
            echo "</form>";
            echo "<hr>";
        }
        ?>

        <a href="admin_dashboard.php">Go back to Admin Dashboard</a>
    </div>
</body>
</html>
