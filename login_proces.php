<?php
$host = "localhost";
$user = "root";
$pass = ""; // sesuaikan jika ada password
$db   = "list";

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Buat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek kecocokan user
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login sukses
    header("Location: index.html");
    exit();
} else {
    // Gagal login
    echo "Login gagal. Username atau password salah.";
}

$conn->close();
?>
