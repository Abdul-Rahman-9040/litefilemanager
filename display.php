<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/footernav.css">
  <link rel="stylesheet" type="text/css" href="css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
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
        <a href="display.php"><i class='fa fa-trash' style='font-size:24px'></i>&emsp;Delete Documents</a>
        <a href="login.html"><i class='fa fa-sign-out' style='font-size:24px'></i>&emsp;Logout</a>  
      </div>
      <style>
        form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        label {
            margin-right: 10px;
        }

        #search {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Make forms appear on new lines */
        form:not(:first-child) {
            margin-top: 10px;
        }
      </style>
   <div class="content">
    <div class="container">
    <?php
// Assuming you have a database connection
include("conn.php");

// Fetch data from uploaded_notes table
$sql_notes = "SELECT *, 'uploaded_notes' as table_name FROM uploaded_notes";
$result_notes = $conn->query($sql_notes);

// Fetch data from uploaded_internals table
$sql_internals = "SELECT *, 'uploaded_internals' as table_name FROM uploaded_internals";
$result_internals = $conn->query($sql_internals);

// Fetch data from uploaded_prev table
$sql_prev = "SELECT *, 'uploaded_prev' as table_name FROM uploaded_prev";
$result_prev = $conn->query($sql_prev);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
</head>
<body>

<h1 style="text-align:center">Delete</h1>

<?php
// Start the session
session_start();

// Get the logged-in username from the session
$loggedInUsername = $_SESSION['username'];

// Display data from uploaded_notes table
displayTable("Uploaded Notes", $result_notes, $loggedInUsername);

// Display data from uploaded_internals table
displayTable("Uploaded Internals", $result_internals, $loggedInUsername);

// Display data from uploaded_prev table
displayTable("Uploaded Previous", $result_prev, $loggedInUsername);

// Function to display HTML table
function displayTable($tableName, $result, $loggedInUsername)
{
    echo "<h2>$tableName</h2>";

    if ($result !== false && $result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Scheme</th>
                    <th>Uploaded Date</th>
                    <th>Semester</th>
                    <th>Subject</th>
                    <th>Internal/Module</th>
                    <th>Delete</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            // Check if the user_name matches the logged-in user
            if ($row['user_name'] === $loggedInUsername) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['scheme']}</td>
                        <td>{$row['uploaded_date']}</td>
                        <td>{$row['semester']}</td>
                        <td>{$row['subject']}</td>
                        <td>";

                // Check if the key "internal" exists in the row
                if (isset($row['internal'])) {
                    echo $row['internal'];
                } elseif (isset($row['module'])) {
                    echo $row['module'];
                } else {
                    echo "N/A";
                }

                echo "</td>
                        <td><a href='delete.php?id={$row['id']}&user_name={$row['user_name']}&table={$row['table_name']}'>Delete</a></td>
                      </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p>No data found in $tableName table.</p>";
    }
}
?>

</body>
</html>

<?php
// Close the database connection
if ($conn !== null) {
    $conn->close();
}
?>


    </div>
   </div>
  <p style="padding-top:600px"></p>
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


