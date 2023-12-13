<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Include your database connection code (e.g., 'conn.php')
    include 'conn.php';

    // Query to fetch username and user_type
    $query = "SELECT username, user_type FROM userregister WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $user_type = $row['user_type'];
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit;
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
    <a href="uploadnotes.html"><i class='fa fa-book' style='font-size:24px'></i>&emsp;Upload Notes</a>
    <a href="viewnotes.html"><i class='fa fa-book' style='font-size:24px'></i>&emsp;View Notes</a>
    <a href="uploadprevious.html"style="font-size:13px"><i class='fa fa-file-pdf-o' style='font-size:24px'></i>&emsp;Upload Previous year Papers</a>
    <a href="viewprevious.html"style="font-size:13px"><i class='fa fa-file-pdf-o' style='font-size:24px'></i>&emsp;View Previous year Papers</a>
    <a href="uploadinternals.html" style="font-size:13px"><i class='fa fa-edit' style='font-size:24px'></i>&emsp;Upload Internal Question papers</a>
    <a href="viewinternals.html" style="font-size:13px"><i class='fa fa-edit' style='font-size:24px'></i>&emsp;View Internal Question papers</a>  
    <a href="display.php" ><i class='fa fa-trash' style='font-size:24px'></i>&emsp;Delete Documents</a> 
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
  <div class="welcome-message">
        <?php
            $imagePath = 'img/admin.png';
            echo '<img src="' . $imagePath . '" alt="Local Image" width="250px" height="auto"/>';
            echo "<p>Welcome, " . $username . "!</p>";
            echo "<p> " . $user_type . "</p>";
        ?>

    </div>
    
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

