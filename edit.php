<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
} else {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'");
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Mahasiswa</title>
  <style>
    :root {
      --bg-color: #ffffff;
      --text-color: #1a1a1a;
      --card-bg: #f0f0f0;
      --accent: #3498db;
    }

    body.dark {
      --bg-color: #121212;
      --text-color: #f5f5f5;
      --card-bg: #1f1f1f;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      padding: 2rem;
      transition: background-color 0.3s ease, color 0.3s ease;
      min-height: 100vh;
    }

    h2 {
      text-align: center;
      color: var(--accent);
      margin-bottom: 1.5rem;
    }

    .form-container {
      max-width: 600px;
      margin: auto;
      background: var(--card-bg);
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
    }

    input, select, textarea {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      background: white;
      color: black;
    }

    body.dark input, 
    body.dark select, 
    body.dark textarea {
      background: #2c2c2c;
      color: white;
      border: 1px solid #555;
    }

    .btn {
      background: var(--accent);
      color: white;
      padding: 0.7rem 1.2rem;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
    }

    .btn:hover {
      background: #2980b9;
    }

    .back-link {
      display: inline-block;
      margin-top: 1rem;
      text-decoration: none;
      color: var(--text-color);
    }

    .back-link:hover {
      color: var(--accent);
    }

    .theme-toggle {
      position: fixed;
      bottom: 1rem;
      right: 1rem;
      background: transparent;
      border: 2px solid var(--accent);
      color: var(--text-color);
      border-radius: 50%;
      width: 50px;
      height: 50px;
      font-size: 1.2rem;
      cursor: pointer;
      transition: background 0.3s ease, color 0.3s ease;
    }

    .theme-toggle:hover {
      background: var(--accent);
      color: white;
    }

    @media screen and (max-width: 600px) {
      body {
        padding: 1rem;
      }
      .form-container {
        padding: 1rem;
      }
      .theme-toggle {
        width: 45px;
        height: 45px;
      }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Mahasiswa</h2>
    <form action="" method="post">
      <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa'] ?>">

      <label for="nim">NIM</label>
      <input type="text" name="nim" value="<?= $data['nim'] ?>" required>

      <label for="nama">Nama</label>
      <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

      <label for="jenis_kelamin">Jenis Kelamin</label>
      <select name="jenis_kelamin" required>
        <option value="P" <?= $data['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
        <option value="L" <?= $data['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
      </select>

      <label for="jurusan">Jurusan</label>
      <input type="text" name="jurusan" value="<?= $data['jurusan'] ?>" required>

      <label for="alamat">Alamat</label>
      <textarea name="alamat" required><?= $data['alamat'] ?></textarea>

      <label for="kebiasaan">Kebiasaan</label>
      <textarea name="kebiasaan" required><?= $data['kebiasaan'] ?></textarea>

      <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
    <a href="mahasiswa.php" class="back-link">&larr; Kembali ke List Mahasiswa</a>
  </div>

  <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

  <script>
    function toggleTheme() {
      document.body.classList.toggle('dark');
      localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    }

    window.onload = () => {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme === 'dark') {
        document.body.classList.add('dark');
      }
    };
  </script>
</body>
</html>
