<?php
// Mulai sesi
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "adoptme");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch user data from the 'users' table
$queryUser = "SELECT * FROM users WHERE email = '$email'";
$resultUser = $conn->query($queryUser);

// Fetch admin data from the 'admin' table
$queryAdmin = "SELECT * FROM admin WHERE email = '$email'";
$resultAdmin = $conn->query($queryAdmin);

if ($resultUser->num_rows > 0) {
    // User found, check password
    $row = $resultUser->fetch_assoc();
    if ($password === $row['password']) {
        // Passwords match, login successful

        // Set user type in session
        $_SESSION['user_type'] = 'user';

        echo "<script>
                alert('Login successful!');
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 1000); // Redirect after 1 second
              </script>";
        exit();
    } else {
        // Incorrect password
        echo "<script>
                alert('Login failed. Incorrect password.');
                window.location.href = 'login19.html';
              </script>";
    }
} elseif ($resultAdmin->num_rows > 0) {
    // Admin found, check password
    $row = $resultAdmin->fetch_assoc();
    if ($password === $row['password']) {
        // Passwords match, login successful

        // Set user type in session
        $_SESSION['user_type'] = 'admin';

        echo "<script>
                alert('Login successful!');
                setTimeout(function() {
                    window.location.href = 'admin/index.html';
                }, 1000); // Redirect after 1 second
              </script>";
        exit();
    } else {
        // Incorrect password
        echo "<script>
                alert('Login failed. Incorrect password.');
                window.location.href = 'login19.html';
              </script>";
    }
} else {
    // User not found
    echo "<script>
            alert('Login failed. User not found.');
            window.location.href = 'login19.html';
          </script>";
}

// Close the database connection
$conn->close();
?>
