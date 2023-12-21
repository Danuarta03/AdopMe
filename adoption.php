<?php
// Pastikan file ini disimpan dengan nama adoption.php

// Fungsi untuk membersihkan input
function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Lakukan koneksi ke database (sesuaikan dengan detail database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adoptme";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Periksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir dan bersihkan input
    $first_name = cleanInput($_POST["first_name"]);
    $last_name = cleanInput($_POST["last_name"]);
    $email = cleanInput($_POST["email"]);
    $phone_number = cleanInput($_POST["phone_number"]);
    $address = cleanInput($_POST["address"]);
    $pet_name = cleanInput($_POST["pet_name"]);
    $reason_for_adoption = cleanInput($_POST["reason_for_adoption"]);

    // Lakukan query untuk menyimpan data ke dalam tabel adoption (sesuaikan dengan struktur tabel Anda)
    $sql = "INSERT INTO adoption (first_name, last_name, email, phone_number, address, pet_name, reason_for_adoption)
            VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$address', '$pet_name', '$reason_for_adoption')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Adoption application has been submitted successfully. Thank you!');
                setTimeout(function() {
                    window.location.href = 'adoption.html';
                }, 2000); // Redirect after 2 seconds
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi ke database
$conn->close();
?>
