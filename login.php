<?php
include 'koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cari user di database
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    // COCOKKAN LANGSUNG (karena tidak di-hash)
    if ($password === $stored_password) {
        echo "success";
    } else {
        echo "fail";
    }
} else {
    echo "fail";
}
