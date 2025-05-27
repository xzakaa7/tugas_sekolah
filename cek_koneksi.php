<?php
include 'koneksi.php';

if ($conn) {
  echo "✅ Koneksi ke database berhasil!";
} else {
  echo "❌ Koneksi gagal: " . mysqli_connect_error();
}
?>
