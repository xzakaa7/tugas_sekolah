<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id";

if (mysqli_query($conn, $sql)) {
  header("Location: mahasiswa.php");
} else {
  echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>

