<?php
include "koneksi.php";

$id_mahasiswa   = $_POST['id_mahasiswa'];
$nim            = $_POST['nim'];
$nama           = $_POST['nama'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$jurusan        = $_POST['jurusan'];
$alamat         = $_POST['alamat'];
$kebiasaan      = $_POST['kebiasaan'];

if (!in_array($jenis_kelamin, ['P', 'L'])) {
    die("Jenis kelamin harus P atau L");
}

$sql = "UPDATE mahasiswa SET 
        nim='$nim',
        nama='$nama',
        jenis_kelamin='$jenis_kelamin',
        jurusan='$jurusan',
        alamat='$alamat',
        kebiasaan='$kebiasaan'
        WHERE id_mahasiswa='$id_mahasiswa'";

if (mysqli_query($conn, $sql)) {
    header("Location: mahasiswa.php");
    exit;
} else {
    echo "Gagal mengupdate data: " . mysqli_error($conn);
}
