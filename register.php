<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "adoptme");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert data into the 'users' table
$query = "INSERT INTO users (Full_name, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($query) === TRUE) {
    echo "<script>
            alert('Registration successful!');
            window.location.href = 'login19.html';
          </script>";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
