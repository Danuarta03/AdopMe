<?php
// Pastikan file ini disimpan dengan nama donation.php

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
    $name = cleanInput($_POST["name"]);
    $phone_number = cleanInput($_POST["phone_number"]);
    $email = cleanInput($_POST["email"]);
    $address = cleanInput($_POST["address"]);
    $pet_name = cleanInput($_POST["pet_name"]);
    $gender = cleanInput($_POST["gender"]);
    $age_of_pet = cleanInput($_POST["age_of_pet"]);
    $size = cleanInput($_POST["size"]);
    $pet_description = cleanInput($_POST["pet_description"]);

    // File upload handling
    $pet_images = $_FILES['pet_images']['tmp_name'];
    $health_certificate = $_FILES['health_certificate']['tmp_name'];

    // Ensure the files are not empty
    if (!empty($pet_images) && !empty($health_certificate)) {
        $pet_images_content = addslashes(file_get_contents($pet_images));
        $health_certificate_content = addslashes(file_get_contents($health_certificate));
    } else {
        // Handle the case where one or both files are empty
        echo "Error: Please upload both pet images and health certificate.";
        exit;
    }

    // Lakukan query untuk menyimpan data ke dalam tabel donasi (sesuaikan dengan struktur tabel Anda)
    $sql = "INSERT INTO donation (name, phone_number, email, address, pet_name, gender, age_of_pet, size, pet_description, pet_images, health_certificate)
            VALUES ('$name', '$phone_number', '$email', '$address', '$pet_name', '$gender', '$age_of_pet', '$size', '$pet_description', '$pet_images_content', '$health_certificate_content')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Donation has been successful, data is still in process. please check email regularly');
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 2000); // Redirect after 3 seconds
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi ke database
$conn->close();
?>
