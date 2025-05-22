<?php 
  include ('config/controller.php');
  $data_buku = select("SELECT * FROM buku LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>7Zip.Library - Dark</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="style/jawa.css">
  <style>
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 2rem;
      padding: 2rem;
      justify-items: center;
    }
    .card.card--1 {
      width: 300px;
      height: 420px;
      background: rgba(30, 30, 30, 0.95);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
      display: flex;
      flex-direction: column;
      border: 1.5px solid #333;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card.card--1:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 12px 32px 0 rgba(0,0,0,0.45);
    }
    .card__img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      background: #222;
      background-size: cover;
      background-position: center;
    }
    .card__info {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      padding: 1.2rem 1.2rem 1.2rem 1.2rem;
      color: white;
    }
    .card__title {
      font-size: 1.15rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      min-height: 2.5em;
      line-height: 1.2em;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    .card__category {
      font-size: 0.95rem;
      opacity: 0.9;
      min-height: 3.2em;
      max-height: 3.2em;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 0.5rem;
    }
    .card__by {
      font-size: 0.98rem;
      color: gold;
      margin-bottom: 0.2rem;
    }
    .card__cat {
      font-size: 0.85rem;
      color: #aaa;
    }
    .book-carousel {
      display: flex;
      gap: 2rem;
      overflow-x: auto;
      padding: 2rem 0;
      scroll-snap-type: x mandatory;
    }
    .book-carousel .card {
      min-width: 300px;
      max-width: 320px;
      scroll-snap-align: start;
    }
    .book-carousel::-webkit-scrollbar {
      height: 10px;
      background: #222;
    }
    .book-carousel::-webkit-scrollbar-thumb {
      background: #444;
      border-radius: 5px;
    }
    .book-carousel {
  display: flex;
  gap: 2rem;
  overflow-x: auto;
  padding: 2rem 0;
  scroll-snap-type: x mandatory;
  width: fit-content; /* Supaya ukurannya tidak full-width */
}

  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand fw-bold" href="#">7Zip.Library</a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Left Nav -->
      <ul class="navbar-nav me-3 mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Books</a>
        </li>
      </ul>

      <!-- Search bar -->
      <form class="d-flex mx-auto w-50" role="search" method="GET" action="login.php">
        <input class="form-control me-2" type="search" placeholder="Search for books..." aria-label="Search" name="query" />
        <button class="btn btn-outline-light" type="submit" >Search</button>
      </form>

      <!-- Profile icon and popup -->
      <div class="d-flex align-items-center position-relative">
        <i class="bi bi-person-circle fs-3 text-white" style="cursor: pointer;" onclick="toggleProfilePopup()"></i>

        <div id="profilePopup" class="profile-popup">
          <p class="fw-semibold">Guest</p>
          <a href="login.php" class="btn btn-dark btn-sm logout-btn">Log in</a>
        </div>
      </div>
    </div>
  </div>
</nav>

<style>
  .profile-popup {
    position: absolute;
    top: 60px;
    right: 0;
    background-color: #1e1e1e;
    padding: 15px;
    border-radius: 10px;
    min-width: 120px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    z-index: 999;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function toggleProfilePopup() {
    const popup = document.getElementById('profilePopup');
    popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
  }

  // Tutup popup kalau klik di luar
  document.addEventListener('click', function(event) {
    const popup = document.getElementById('profilePopup');
    const icon = document.querySelector('.bi-person-circle');
    if (!popup.contains(event.target) && !icon.contains(event.target)) {
      popup.style.display = 'none';
    }
  });
</script>


  <!-- Welcome Section -->
  <div class="container-fluid px-3 mt-4 position-relative" style="min-height: 500px;">
    <img src="images/gmbr.webp" class="bg" alt="#">
    <h1 class="welcome-text">Welcome to 7Zip-Library!</h1>
  </div>

  <!-- Cards -->
<div class="d-flex justify-content-center">
  <div class="book-carousel">
    <?php foreach($data_buku as $info_buku): ?>
      <article class="card card--1" onclick="window.location.href='<?= $info_buku['url'] ?>?from=index';">
        <div class="card__img" style="background-image: url('<?= $info_buku['cover'];?>')"></div>
        <div class="card__img--hover" style="background-image: url('<?= $info_buku['cover'];?>')"></div>
        <div class="card__info">
          <span class="card__category"><?= $info_buku['deskripsi'];?></span>
          <h3 class="card__title"><?= $info_buku['judul'];?></h3>
          <span class="card__by" style="color:gold">by <?= $info_buku['pengarang'];?></span>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>


  <!-- Footer -->
  <footer class="footer mt-5">
    <!-- <p>&copy; 2025 7Zip.Library</p> -->
    <ul class="logo">
  <li style="--i:#a955ff;--j:#ea51ff">
    <span class="icon"><ion-icon name="logo-instagram"></ion-icon></span>
    <span class="title"><a style="text-decoration:none; color:white" href="https://www.instagram.com/lallslthn_?igsh=a2Iwejlxa29saTYx">@lallslthn_</a></span>
  </li>
  <!-- <li style="--i:#FF9966;--j:#FF5E62">
    <span class="icon"><ion-icon name="mail"></ion-icon></span>
    <span class="title"><a href="mailto:hilalsulthanuladzam@gmail.com" style="text-decoration:none; color:white">Email Me</a></span>
  </li> -->

  </ul>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </footer>

</body>
</html>
