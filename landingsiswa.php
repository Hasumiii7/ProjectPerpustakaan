  <?php 
    include ('config/controller.php');
    session_start();

    if (!isset($_SESSION['nama_user'])) {
        header("Location: index.php");
        exit;
    }

    $nama_user = $_SESSION['nama_user'];
    $level = $_SESSION['level'];

    $data_buku = select("SELECT * FROM buku LIMIT 7");
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
    <link rel="stylesheet" href="style/jawa.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    

    <style>
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
      .profile-popup {
        display: none;
        position: absolute;
        top: 60px;
        right: 20px;
        background-color: #1e1e1e;
        padding: 15px;
        border-radius: 10px;
        min-width: 200px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        z-index: 999;
      }
      .profile-popup p {
        margin: 0;
        color: white;
      }
      .profile-popup .logout-btn {
        margin-top: 15px;
        display: block;
        width: 100%;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand fw-bold text-white" href="#">7Zip.Library</a>

    <!-- Navbar Toggler for Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Left: Link -->
      <ul class="navbar-nav me-3 mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" href="books.php">Books</a>
        </li>
      </ul>

      <!-- Middle: Search Bar -->
      <form class="d-flex mx-auto w-50" role="search" action="search.php" method="GET">
        <input class="form-control me-2" type="search" name="query" placeholder="Search for books..." aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>

      <!-- Right: Profile Icon -->
      <div class="d-flex align-items-center position-relative">
        <i class="bi bi-person-circle text-white fs-3" style="cursor: pointer;" onclick="toggleProfilePopup()"></i>

        <!-- Profile Popup -->
        <div id="profilePopup" class="profile-popup">
          <p class="fw-semibold"><?= htmlspecialchars($nama_user); ?></p>
          <p class="text-white-50 small"><?= htmlspecialchars($level); ?></p>
          <a href="logout.php" class="btn btn-dark btn-sm logout-btn">Log out</a>
        </div>
      </div>
    </div>
  </div>
</nav>


    <!-- Welcome Section -->
    <div class="container-fluid px-3 mt-4 position-relative" style="min-height: 500px;">
      <img src="images/gmbr.webp" class="bg" alt="#">
      <h1 class="welcome-text">Welcome to the library, <?= htmlspecialchars($nama_user); ?>!</h1>
    </div>

    <!-- Book Cards -->
    <div class="book-carousel">
      <?php foreach($data_buku as $info_buku): ?>
        <article class="card card--1" onclick="window.location.href='<?= $info_buku['url'] ?>?from=landingsiswa';">
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

    <footer class="footer mt-5"></footer>

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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
  </html>
