<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $user_type = $_POST["user_type"];
    $full_name = $_POST["full_name"];
    include 'conn.php';

    $check_username_query = "SELECT * FROM userregister WHERE username = '$username'";
    $check_email_query = "SELECT * FROM userregister WHERE email = '$email'";
    
    $result_username = mysqli_query($conn, $check_username_query);
    $result_email = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result_username) > 0 && mysqli_num_rows($result_email) > 0) {
        echo "<script>
                alert('Username or email already exist. Please choose different ones.');
                window.location.href = 'signup.html';
              </script>";
    } elseif (mysqli_num_rows($result_username) > 0) {
        echo "<script>
                alert('Username already exists. Please choose a different username.');
                window.location.href = 'signup.html';
              </script>";
    } elseif (mysqli_num_rows($result_email) > 0) {
        echo "<script>
                alert('Email address is already registered. Please use a different email.');
                window.location.href = 'signup.html';
              </script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>
                alert('Passwords do not match. Please try again.');
                window.location.href = 'signup.html';
              </script>";
    } else {
        

        $sql = "INSERT INTO signup_requests (full_name, username, email, password, user_type) 
                VALUES ('$full_name', '$username', '$email', '$password', '$user_type')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Registered successfully. Your registration is pending approval.');
                    window.location.href = 'login.html';
                 </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>
