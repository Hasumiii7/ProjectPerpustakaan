<?php 
include 'config/controller.php';
session_start();

if (!isset($_SESSION['nama_user'])) {
    header("Location: index.php");
    exit;
}

$nama_user = $_SESSION['nama_user'];
$level = $_SESSION['level']; // enum: admin, petugas, siswa
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>7Zip.Library - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="style/jawa.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #121212;
      color: white;
      margin: 0;
      padding: 0;
    }
    /* Background Image Fullscreen */
    .bg {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      object-fit: cover;
      filter: blur(11);
      z-index: -1;
    }
    /* Navbar */
    nav.navbar {
      background-color: #1f1f1f;
      padding: 0.75rem 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.7);
    }
    nav .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #f8f9fa;
      letter-spacing: 1.1px;
    }
    /* Profile icon on right */
    .profile-popup {
      display: none;
      position: absolute;
      top: 50px;
      right: 20px;
      background-color: #272727;
      padding: 1rem 1.2rem;
      border-radius: 12px;
      min-width: 220px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.7);
      z-index: 1000;
      user-select: none;
    }
    .profile-popup p {
      margin: 0;
      color: white;
      font-weight: 600;
      letter-spacing: 0.05em;
    }
    .profile-popup p.text-white-50 {
      color: #bbb;
      font-size: 0.9rem;
      margin-bottom: 12px;
    }
    .profile-popup .logout-btn {
      width: 100%;
      background-color: #343a40;
      border: none;
      font-weight: 600;
      letter-spacing: 0.05em;
      transition: background-color 0.25s ease;
    }
    .profile-popup .logout-btn:hover {
      background-color: #495057;
      color: #fff;
    }
    /* Welcome text */
    .welcome-text {
      font-weight: 600;
      font-size: 2.8rem;
      margin-top: 2rem;
      margin-left: -3rem;
      text-shadow: 0 0 10px rgba(0,0,0,0.9);
    }
    /* Container for buttons */
    .btn-section {
      margin-top: 2.5rem;
      max-width: 1100px;
      margin-left: auto;
      margin-right: auto;
    }
    .btn-section .btn {
      background: transparent;
      border: 2px solid white;
      color: white;
      font-weight: 600;
      font-size: 1.15rem;
      border-radius: 15px;
      padding: 1.8rem 1.5rem;
      box-shadow: 0 0 12px rgba(255, 255, 255, 0.15);
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      height: 160px;
    }
    .btn-section .btn i {
      font-size: 2.8rem;
      color: gold;
      transition: color 0.3s ease;
    }
    .btn-section .btn:hover {
      background-color: gold;
      color: #121212;
      border-color: gold;
      box-shadow: 0 0 18px gold;
      text-decoration: none;
    }
    .btn-section .btn:hover i {
      color: #121212;
    }
    /* Bagian hero dengan gambar background terbatas */
.hero-section {
  position: relative;
  width: 100%;
  height: 50vh;  /* tinggi gambar dibatasi 60% viewport height */
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-bg {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
  filter: brightness(0.8);
}

.welcome-text-container {
  position: relative;
  z-index: 1;
  color: white;
  text-align: center;
  padding: 0 1rem;
  font-family: 'Montserrat', sans-serif;
  margin-left: -50em;
}

.welcome-text {
  font-weight: 600;
  font-size: 4rem;
  text-shadow: 0 0 10px rgba(0,0,0,0.7);
}

/* Tombol bagian bawah dengan background hitam */
.btn-section {
  background-color: #121212;
  color: white;
}

/* Styling tombol, bisa kamu sesuaikan */
.btn-outline-light {
  border-radius: 15px;
  font-weight: 600;
  font-size: 1.1rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
}

.btn-outline-light i {
  font-size: 2.5rem;
  color: gold;
}

.btn-outline-light:hover {
  background-color: gold;
  color: #121212;
  border-color: gold;
}

.btn-outline-light:hover i {
  color: #121212;
}
.custom-btn {
  min-width: 300px;
  width: 320px; /* Ganti ini ke 100% jika ingin full lebar parent */
  max-width: 400px;
  padding: 2rem 1.5rem;
  border-radius: 20px;
  text-align: center;
  font-weight: 600;
  font-size: 1.2rem;
  transition: 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.6rem;
}

.custom-btn i {
  font-size: 2.8rem;
  color: gold;
}

.custom-btn:hover {
  background-color: gold;
  color: #121212;
  border-color: gold;
}

.custom-btn:hover i {
  color: #121212;
}


    /* Responsive */
    @media (max-width: 768px) {
      .welcome-text {
        font-size: 2rem;
        margin-left: 1rem;
        margin-right: 1rem;
      }
      .btn-section .btn {
        font-size: 1rem;
        height: 140px;
        padding: 1.3rem 1rem;
      }
      .btn-section .btn i {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">7Zip.Library</a>
      <div class="ms-auto d-flex align-items-center position-relative">
        <i class="bi bi-person-circle text-white fs-3" style="cursor: pointer;" onclick="toggleProfilePopup()"></i>
        <div id="profilePopup" class="profile-popup">
          <p class="fw-semibold"><?= htmlspecialchars($nama_user); ?></p>
          <p class="text-white-50 small"><?= htmlspecialchars($level); ?></p>
          <a href="logout.php" class="btn logout-btn btn-sm">Log out</a>
        </div>
      </div>
    </div>
  </nav>

   <section class="hero-section">
    <img src="images/gmbr.webp" alt="Background" class="hero-bg" />
    <div class="welcome-text-container">
      <h1 class="welcome-text">Welcome to Admin Panel, <?= htmlspecialchars($nama_user); ?>!</h1>
    </div>
  </section>

  <!-- Bagian bawah dengan background hitam dan tombol -->
  <section class="btn-section text-white py-3">
  <div class="container">
    <div class="d-flex justify-content-center flex-wrap gap-4">
      <a href="kategori.php" class="btn btn-outline-light custom-btn flex-fill">
        <i class="fas fa-book"></i><br />
        Manage Book Categories
      </a>
      <a href="tableadmin.php" class="btn btn-outline-light custom-btn flex-fill">
        <i class="fas fa-users"></i><br />
        Manage User Accounts
      </a>
      <a href="tablebuku.php" class="btn btn-outline-light custom-btn flex-fill">
        <i class="bi bi-book-half"></i><br />
        Manage Books
      </a>
    </div>
  </div>
</section>



  <script>
    function toggleProfilePopup() {
      const popup = document.getElementById('profilePopup');
      popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
    }
    document.addEventListener('click', function(event) {
      const popup = document.getElementById('profilePopup');
      const icon = document.querySelector('.bi-person-circle');
      if (!popup.contains(event.target) && !icon.contains(event.target)) {
        popup.style.display = 'none';
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
