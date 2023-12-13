<?php
session_start();

include("conn.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the account is rejected in signup_requests table
    $reject_stmt = $conn->prepare("SELECT reject FROM signup_requests WHERE username = ? AND password = ?");
    $reject_stmt->bind_param("ss", $username, $password);
    $reject_stmt->execute();
    $reject_stmt->bind_result($reject);
    $reject_stmt->fetch();
    $reject_stmt->close();

    if ($reject == 1) {
        // Account is rejected
        $_SESSION['login_error'] = "Your account has been rejected.";
        echo "<script>
        alert('Your account has been rejected. Please contact the administrator.');
        window.location.href = 'login.html';
        </script>";
        exit;
    }
    else{
        echo "<script>
        alert('Your account is not validated yet.Please contact the administrator');
        window.location.href = 'login.html';
        </script>";
    }

    // Check if the login credentials match the administrator table
    $admin_stmt = $conn->prepare("SELECT user_type FROM administrator WHERE username = ? AND password = ?");
    $admin_stmt->bind_param("ss", $username, $password);
    $admin_stmt->execute();
    $admin_stmt->bind_result($admin_user_type);
    $admin_stmt->fetch();
    $admin_stmt->close();

    if (!empty($admin_user_type)) {
        // Admin login successful
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $admin_user_type;
        header("Location: admin_dashboard1.php");
        exit;
    }else
    {
        echo "<script>
        alert(Invalid Adminstartion username or password');
        window.location.href = 'login.html';
        </script>";   
    }

    // Check the userregister table if the login credentials are not for an admin
    $stmt = $conn->prepare("SELECT user_type FROM userregister WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($user_type);

    if ($stmt->fetch()) {
        // Close the first query result set
        $stmt->close();

        // Account is approved, proceed with login
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;

        if ($user_type === "user") {
            // Redirect to the user dashboard
            header("Location: user_dashboard.php");
            exit;
        }
        elseif($user_type === "admin")
        {
            header("Location:admin_dashboard.php");
            exit;
        }
       
    }

    // If login fails, set an error message and redirect to the login page
    $_SESSION['login_error'] = "Incorrect username or password.";
    echo "<script>
    alert('Username or password is incorrect. Please try again.');
    window.location.href = 'login.html';
    </script>";
    exit;
}

$conn->close();
?>
