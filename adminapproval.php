<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Include your database connection code (e.g., 'conn.php')
    include 'conn.php';

    // Query to fetch username and user_type
    $query = "SELECT username, user_type FROM userregister WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    

}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/footernav.css">
</head>
<body>
  <div class="sidebar">
    <a href="admin_dashboard.php"><i class="fa fa-home" style="font-size:24px"></i>&emsp;Home</a>
    <a href="viewstudents.html"><i class="fa fa-user" style="font-size:24px"></i>&emsp;View Users</a>
    <a href="viewadmins.html"><i class='fa fa-id-card' style='font-size:24px'></i>&emsp;View admins</a>
    <a href="adminapproval.php"><i class='fa fa-check' style='font-size:24px'></i>&emsp;Approve/Reject</a>
    <a href="login.html"><i class='fa fa-sign-out' style='font-size:24px'></i>&emsp;Logout</a>  
  </div>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .welcome-message {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .welcome-message p {
            font-size: 24px;
        }
    </style>
  <div class="content">
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
                $insert_sql = "INSERT INTO userregister (username, email, password, user_type, full_name) 
                                VALUES ('{$row['username']}', '{$row['email']}', '{$row['password']}', '{$row['user_type']}', '{$row['full_name']}')";

                // Delete the user from signup_requests
                $delete_sql = "DELETE FROM signup_requests WHERE username = '$username'";

                if ($conn->query($insert_sql) === TRUE && $conn->query($delete_sql) === TRUE) {
                    echo "User approved ";
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

    
  </div>
  <p style="padding-top:400px"></p>
  <div class="footer">
        <div class="footer-content">
            <p style="padding-left:100px">&copy; 2023 LiteFile Manager. All rights reserved.</p>
            <ul>
                <li><a href="#">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</body>
</html>

