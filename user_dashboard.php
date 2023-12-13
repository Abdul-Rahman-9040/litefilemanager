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
  <link rel="stylesheet" type="text/css" href="css/footernav.css">
  <link rel="stylesheet" type="text/css" href="css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="sidebar">
    <a href="user_dashboard.php"><i class="fa fa-home" style="font-size:24px"></i>&emsp;Home</a>
    <a href="userviewnotes.html"><i class='fa fa-book' style='font-size:24px'></i>&emsp;View Notes</a>
    <a href="userviewprevious.html"style="font-size:13px"><i class='fa fa-file-pdf-o' style='font-size:24px'></i>&emsp;View Previous year Papers</a>
    <a href="userviewinternals.html" style="font-size:13px"><i class='fa fa-edit' style='font-size:24px'></i>&emsp;View Internal Question papers</a>    
    <a href="login.html"><i class='fa fa-sign-out' style='font-size:24px'></i>&emsp;Logout</a>  
  </div>
  <style>

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
            $imagePath = 'img/user.png';
            echo '<img src="' . $imagePath . '" alt="Local Image" width="250px" height="auto"/>';
            echo "<p>Welcome, " . $username . "!</p>";
            echo "<p> " . $user_type . "</p>";
        ?>
    </div>
  </div>
</body>
</html>

