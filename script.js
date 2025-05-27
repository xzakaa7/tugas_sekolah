

    // Tampilkan/sembunyikan popup profil
const profileIcon = document.getElementById('profileIcon');
const popupMenu = document.getElementById('popupMenu');

profileIcon.addEventListener('click', () => {
  popupMenu.style.display = popupMenu.style.display === 'block' ? 'none' : 'block';
});

// Tutup popup jika klik di luar
document.addEventListener('click', function(e) {
  if (!profileIcon.contains(e.target) && !popupMenu.contains(e.target)) {
    popupMenu.style.display = 'none';
  }
});

// Logout ke login.html
document.getElementById('logoutBtn').addEventListener('click', function () {
  popupMenu.style.display = 'none';
  setTimeout(() => {
    window.location.href = 'login.html';
  }, 300);
});



// Toggle popup menu
profileIcon.addEventListener('click', (e) => {
  e.stopPropagation(); // agar klik ikon tidak memicu document click
  popupMenu.classList.toggle('active');
});

// Logout tombol redirect ke login.html
logoutBtn.addEventListener('click', () => {
  window.location.href = 'login.html';
});

// Klik di luar popup untuk tutup popup
document.addEventListener('click', () => {
  popupMenu.classList.remove('active');
});

    function navigateWithFade(url) {
  const box = document.getElementById("content-box");
  box.classList.remove("show"); // Trigger fade-out
  setTimeout(() => {
    window.location.href = url;
  }, 400); // Delay sesuai durasi animasi
}

    function toggleTheme() {
      document.body.classList.toggle("dark-theme");
      const isDark = document.body.classList.contains("dark-theme");
      localStorage.setItem("theme", isDark ? "dark" : "light");
    }

    // Aktifkan tema yang disimpan
    window.addEventListener("DOMContentLoaded", () => {
      const savedTheme = localStorage.getItem("theme");
      if (savedTheme === "dark") {
        document.body.classList.add("dark-theme");
      }
    });

    const contentMap = {
      html: {
        title: "HTML Dasar",
        content: "HTML (HyperText Markup Language) digunakan untuk menyusun struktur konten dalam halaman web seperti teks, gambar, dan link."
      },
      css: {
        title: "CSS Dasar",
        content: "CSS (Cascading Style Sheets) digunakan untuk memperindah tampilan HTML, seperti warna, layout, dan tipografi."
      },
      php: {
        title: "PHP Dasar",
        content: "PHP adalah bahasa server-side untuk membuat halaman web dinamis dan dapat berinteraksi dengan database."
      },
      js: {
        title: "JavaScript Dasar",
        content: "JavaScript adalah bahasa pemrograman yang berjalan di browser untuk membuat website menjadi interaktif."
      },

       list: {
        title: "JavaScript Dasar",
        content: "JavaScript adalah bahasa pemrograman yang berjalan di browser untuk membuat website menjadi interaktif."
      }
    };

    function loadContent(type) {
      const box = document.getElementById("content-box");
      box.classList.remove("show");
      setTimeout(() => {
        if (contentMap[type]) {
          box.innerHTML = `<h2>${contentMap[type].title}</h2><p>${contentMap[type].content}</p>`;
        } else {
          box.innerHTML = `<h2>Konten Tidak Ditemukan</h2><p>Silakan pilih topik yang tersedia.</p>`;
        }
        box.classList.add("show");
      }, 300);
    }

    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("show");
    }

        window.addEventListener('DOMContentLoaded', () => {
      document.body.classList.add('fade-in');
    });
  