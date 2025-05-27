<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>List Mahasiswa</title>
  <style>
    :root {
      --bg-light: #f2f2f2;
      --bg-dark: #1e1e1e;
      --text-light: #000;
      --text-dark: #fff;
      --table-bg-light: #fff;
      --table-bg-dark: #2c2c2c;
      --th-bg-light: #333;
      --th-bg-dark: #444;
      --border-light: #ccc;
      --border-dark: #555;
    }

    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background-color: var(--bg-light);
      color: var(--text-light);
      transition: all 0.3s ease;
    }

    body.dark {
      background-color: var(--bg-dark);
      color: var(--text-dark);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: var(--table-bg-light);
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: background 0.3s ease;
    }

    body.dark table {
      background: var(--table-bg-dark);
    }

    th, td {
      padding: 10px;
      border: 1px solid var(--border-light);
      text-align: center;
    }

    th {
      background-color: var(--th-bg-light);
      color: white;
    }

    body.dark th {
      background-color: var(--th-bg-dark);
    }

    body.dark td,
    body.dark th {
      border-color: var(--border-dark);
    }

    .top-buttons {
      margin-bottom: 1rem;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .top-buttons a {
      padding: 8px 16px;
      background: #28a745;
      color: white;
      border-radius: 4px;
      margin-bottom: 10px;
      text-decoration: none;
    }

    .top-buttons a:hover {
      background: #218838;
    }

    .actions a {
      padding: 4px 10px;
      font-size: 0.9rem;
      background: #007bff;
      color: white;
      border-radius: 4px;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s ease;
    }

    .actions a:hover {
      background: #0056b3;
    }

    .actions .delete {
      background: #dc3545;
    }

    .actions .delete:hover {
      background: #b02a37;
    }

    .theme-toggle {
      padding: 8px 16px;
      background: #333;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      position: fixed;
      bottom: 20px;
      right: 20px;
      transition: background 0.3s ease;
    }

    .theme-toggle:hover {
      background: #555;
    }

    body.dark .theme-toggle {
      background: #eee;
      color: #000;
    }

    body.dark .theme-toggle:hover {
      background: #ddd;
    }
  </style>
</head>
<body>
  <div class="top-buttons">
    <a href="index.html">&larr; Kembali ke Beranda</a>
    <a href="tambah.php">+ Tambah Mahasiswa</a>
  </div>

  <h2>Daftar Mahasiswa</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Jurusan</th>
      <th>Alamat</th>
      <th>Kebiasaan</th>
      <th>Aksi</th>
    </tr>
    <?php
    $sql = "SELECT * FROM mahasiswa";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_mahasiswa']}</td>
                <td>{$row['nim']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['jenis_kelamin']}</td>
                <td>{$row['jurusan']}</td>
                <td>{$row['alamat']}</td>
                <td>{$row['kebiasaan']}</td>
                <td class='actions'>
                  <div style='display: flex; justify-content: center; gap: 8px;'>
                    <a href='edit.php?id={$row['id_mahasiswa']}'>Edit</a>
                    <a href='hapus.php?id={$row['id_mahasiswa']}' class='delete' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                  </div>
                </td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Tidak ada data mahasiswa.</td></tr>";
    }
    ?>
  </table>

  <button class="theme-toggle" onclick="toggleTheme()">🌓 Ganti Mode</button>

  <script>
    function toggleTheme() {
      document.body.classList.toggle('dark');
      localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    }

    window.onload = function () {
      if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
      }
    }
  </script>
</body>
</html>
