<?php 
include 'config/controller.php';
//sql menampilkan
$data_login = select("SELECT * FROM login WHERE level ='petugas'");
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing Page - Petugas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
        <link rel="stylesheet" href="style/jawa.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
    </head>
    <body>
    <!-- <div class="kontener" style="background-image: url(images/gmbr.webp); width:100vw; height:100vh; background-size: cover; background-position: center; opacity:95%">
        <nav class="navbar navbar-expand-lg navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="landingadmin.php">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tablepetugas.php">Management Account</a>
                        </li>
                    </ul>
                </div>
              <button type="button" class="btn btn-outline-light" onclick="window.location.href='index.php'" >Log-out</button>
            </div>
        </nav> -->
        <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white" href="#">7Zip.Library</a>
      <div class="ms-auto d-flex align-items-center">
        <div class="d-flex align-items-center">
          <a class="nav-link text-white me-4" href="kategori.php">Book Category</a>
          <a class="nav-link text-white me-4" href="tableadmin.php">Account Management</a>
          <!-- <form class="d-flex me-4" action="search.php" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search for books..." />
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form> -->
          <a href="#" onclick="confirmLogout()" class="btn btn-outline-light">Log-out</a>
        </div>
      </div>
    </div>
  </nav>

        <?php
        session_start();

            // Cek apakah user sudah login
            if (!isset($_SESSION['nama_user'])) {
                header("Location: login.php");
                exit;
            }

        $nama_user = $_SESSION['nama_user'];
        ?>

         <div class="container-fluid px-3 mt-4 position-relative" style="min-height: 100vh;">
    <img src="images/gmbr.webp" class="bg" alt="#">
    <div class="position-relative" style="z-index: 1;">
      <h1 class="welcome-text text-start mb-4 ms-5" style="font-weight:600;">
         Welcome to Petugas Panel, <?= htmlspecialchars($nama_user); ?>!
      </h1>
      <div class="row justify-content-center mt-5">
        <div class="col-md-4 text-center">
          <a href="kategoripetugas.php" class="btn btn-outline-light btn-lg p-4 w-100 mb-4">
            <i class="fas fa-book mb-3 d-block" style="font-size: 2rem;"></i>
            Manage Book Categories
          </a>
        </div>
        <div class="col-md-4 text-center">
          <a href="tablepetugas.php" class="btn btn-outline-light btn-lg p-4 w-100 mb-4">
            <i class="fas fa-users mb-3 d-block" style="font-size: 2rem;"></i>
            Manage User Accounts
          </a>
        </div>
        <div class="col-md-4 text-center">
          <a href="tablebuku.php" class="btn btn-outline-light btn-lg p-3 w-100 mb-4">
            <i class="bi bi-book-half mb-3 d-block" style="font-size: 2rem;"></i>
            Manage Books
          </a>
        </div>
      </div>
    </div>
  </div>

        


    </div>
    <script>
    function confirmLogout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        window.location.href = 'logout.php';
      }
    }
  </script>
    </body>
    </html>