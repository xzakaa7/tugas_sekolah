<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_mahasiswa = $_POST['id_mahasiswa'];
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jk = $_POST['jenis_kelamin'];
  $jurusan = $_POST['jurusan'];
  $alamat = $_POST['alamat'];
  $kebiasaan = $_POST['kebiasaan'];

  // Validasi jenis kelamin
  if ($jk !== 'L' && $jk !== 'P') {
    echo "Jenis Kelamin hanya boleh L (Laki-laki) atau P (Perempuan)";
    exit;
  }

  // Cek duplikat ID Mahasiswa
  $cek = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
  if (mysqli_num_rows($cek) > 0) {
    echo "ID Mahasiswa sudah digunakan.";
    exit;
  }

  $sql = "INSERT INTO mahasiswa (id_mahasiswa, nim, nama, jenis_kelamin, jurusan, alamat, kebiasaan)
          VALUES ('$id_mahasiswa', '$nim', '$nama', '$jk', '$jurusan', '$alamat', '$kebiasaan')";

  if (mysqli_query($conn, $sql)) {
    header("Location: mahasiswa.php");
    exit;
  } else {
    echo "Gagal menambahkan data: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Mahasiswa</title>
  <style>
    :root {
      --bg-color: #f4f4f4;
      --text-color: #1a1a1a;
      --form-bg: #ffffff;
      --input-bg: #fff;
      --input-border: #ccc;
      --button-bg: #28a745;
      --button-hover-bg: #218838;
      --link-color: #007bff;
    }

    body.dark {
      --bg-color: #121212;
      --text-color: #f5f5f5;
      --form-bg: #1f1f1f;
      --input-bg: #2a2a2a;
      --input-border: #555;
      --button-bg: #4CAF50;
      --button-hover-bg: #388E3C;
      --link-color: #66aaff;
    }

    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: background-color 0.3s ease, color 0.3s ease;
      min-height: 100vh;
    }

    form {
      background-color: var(--form-bg);
      padding: 2rem;
      max-width: 600px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: background-color 0.3s ease;
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: var(--button-bg);
      transition: color 0.3s ease;
    }

    label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      box-sizing: border-box;
      background-color: var(--input-bg);
      border: 1px solid var(--input-border);
      color: var(--text-color);
      transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
      border-radius: 4px;
      font-size: 1rem;
      font-family: inherit;
      resize: vertical;
    }

    button {
      margin-top: 2rem;
      padding: 10px 20px;
      background-color: var(--button-bg);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    button:hover {
      background-color: var(--button-hover-bg);
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
    }

    .back-link a {
      text-decoration: none;
      color: var(--link-color);
      transition: color 0.3s ease;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    .theme-toggle {
      position: fixed;
      bottom: 1rem;
      right: 1rem;
      background: transparent;
      border: 2px solid var(--button-bg);
      color: var(--text-color);
      border-radius: 50%;
      width: 50px;
      height: 50px;
      font-size: 1.2rem;
      cursor: pointer;
      transition: background 0.3s ease, color 0.3s ease, border 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .theme-toggle:hover {
      background: var(--button-bg);
      color: white;
    }

    @media screen and (max-width: 600px) {
      body {
        padding: 1rem;
      }

      .theme-toggle {
        width: 45px;
        height: 45px;
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <form method="post" action="">
    <h2>Tambah Mahasiswa</h2>

    <label for="id_mahasiswa">ID Mahasiswa</label>
    <input type="number" id="id_mahasiswa" name="id_mahasiswa" required />

    <label for="nim">NIM</label>
    <input type="text" id="nim" name="nim" required />

    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" required />

    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin" required>
      <option value="">-- Pilih Jenis Kelamin --</option>
      <option value="L">Laki-laki</option>
      <option value="P">Perempuan</option>
    </select>

    <label for="jurusan">Jurusan</label>
    <input type="text" id="jurusan" name="jurusan" required />

    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="2" required></textarea>

    <label for="kebiasaan">Kebiasaan</label>
    <input type="text" id="kebiasaan" name="kebiasaan" />

    <button type="submit">Simpan</button>

    <div class="back-link">
      <a href="mahasiswa.php">← Kembali ke Daftar Mahasiswa</a>
    </div>
  </form>

  <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">🌓</button>

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
