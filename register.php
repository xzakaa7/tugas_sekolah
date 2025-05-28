<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'list';
$username_db = 'root';
$password_db = '';

$conn = new mysqli($host, $username_db, $password_db, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek request method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data dari form
    $nama     = $_POST['nama'] ?? '';
    $username = $_POST['username'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $no_hp    = $_POST['no_hp'] ?? '';
    $alamat   = $_POST['alamat'] ?? '';

    // Validasi sederhana (optional)
    if (!$nama || !$username || !$email || !$password || !$no_hp || !$alamat) {
        die("Semua field harus diisi.");
    }

    // Prepare statement insert data
    $sql = "INSERT INTO users (nama, username, email, password, no_hp, alamat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare statement gagal: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $nama, $username, $email, $password, $no_hp, $alamat);

     if ($stmt->execute()) {
        // Redirect ke login.html dengan query string
        header("Location: login.html?register=success");
        exit;
    } else {
        // Redirect ke login.html dengan pesan gagal
        header("Location: login.html?register=fail");
        exit;
    }


    $stmt->close();
}

$conn->close();
?>
