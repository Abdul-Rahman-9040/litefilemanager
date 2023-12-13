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

        form {
            display: flex;
            align-items: center;
        }

        label {
            margin-right: 10px;
            margin-left: 40px;
            font-size: 16px;
        }

        #search {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            display: flex;
            align-items: center;
        }

        label {
            margin-right: 10px;
            font-size: 16px;
        }

        #search {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
      </style>
   <div class="content">
    <div class="container">
        <h1 style="text-align:center">Notes</h1>
        <form method="GET" action="">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter keyword">
            &emsp;<button type="submit">Search</button>
        </form>
        <br><br>
    <?php
include 'conn.php'; // Assuming you have a connection file

// Check if a search term is provided
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Perform the search query using the $search value
    $sql = "SELECT * FROM uploaded_notes WHERE subject LIKE '%$search%' OR scheme LIKE '%$search%' OR semester LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    // Display the search results
    if ($result) {
        echo "<table border='1'>";
        echo "<tr><th>User Name</th><th>Scheme</th><th>Uploaded Date</th><th>Semester</th><th>Subject</th><th>Module</th><th>Download</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td>{$row['scheme']}</td>";
            echo "<td>{$row['uploaded_date']}</td>";
            echo "<td>{$row['semester']}</td>";
            echo "<td>{$row['subject']}</td>";
            echo "<td>{$row['module']}</td>";
            $file_path = urlencode($row['document_path']);
            echo "<td><a href='download.php?file={$file_path}' target='_blank'>Download</a></td>";
            echo "</tr>";   
        }

        echo "</table>";
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

} else {
    // No search term provided, display all values in the table
    $sql = "SELECT * FROM uploaded_notes";
    $result = mysqli_query($conn, $sql);

    // Display all values in the table
    if ($result) {
        echo "<table border='1'>";
        echo "<tr><th>User Name</th><th>Scheme</th><th>Uploaded Date</th><th>Semester</th><th>Subject</th><th>Module</th><th>Download</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td>{$row['scheme']}</td>";
            echo "<td>{$row['uploaded_date']}</td>";
            echo "<td>{$row['semester']}</td>";
            echo "<td>{$row['subject']}</td>";
            echo "<td>{$row['module']}</td>";
            echo "<td><a href='{$row['document_path']}' download>Download</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
    </div>
   </div>
  <p style="padding-top:70px"></p>
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



