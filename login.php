<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "list";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statement
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Cek apakah password hash atau polos
    if ($row['password'] === $password) {
        echo "success";
    } else {
        echo "fail";
    }
} else {
    echo "fail";
}

$conn->close();
?>
