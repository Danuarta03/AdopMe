<?php
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
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // User found, check password
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
        // Passwords match, login successful
        echo "<script>
                alert('Login successful!');
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 3000); // Redirect after 3 seconds
              </script>";
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
