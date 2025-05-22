<?php 
include 'config/controller.php';

session_start();
$cache_key = 'books_' . md5($_SERVER['QUERY_STRING']);
$cache_time = 300;

$selected_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Ambil data kategori (pakai session jika sudah ada)
if (!isset($_SESSION['categories'])) {
    $data_kategori = select("SELECT * FROM kategori");
    $_SESSION['categories'] = $data_kategori;
} else {
    $data_kategori = $_SESSION['categories'];
}

if (isset($_SESSION[$cache_key]) && (time() - $_SESSION[$cache_key]['time'] < $cache_time)) {
    $data_buku = $_SESSION[$cache_key]['data'];
} else {
    $sql = "SELECT b.*, k.nama as kategori_nama 
            FROM buku b 
            LEFT JOIN kategori k ON b.id_kategori = k.id_kategori 
            WHERE 1=1";

    $params = [];
    $types = "";

    if ($selected_kategori && $selected_kategori !== 'all') {
        $sql .= " AND b.id_kategori = ?";
        $params[] = $selected_kategori;
        $types .= "s";
    }

    if (!empty($search_query)) {
        $sql .= " AND (b.judul LIKE ? OR b.pengarang LIKE ? OR b.deskripsi LIKE ?)";
        $search_param = "%$search_query%";
        $params = array_merge($params, [$search_param, $search_param, $search_param]);
        $types .= "sss";
    }

    $sql .= " ORDER BY b.judul ASC LIMIT 50";

    $stmt = $db->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $data_buku = $result->fetch_all(MYSQLI_ASSOC);

    $_SESSION[$cache_key] = [
        'time' => time(),
        'data' => $data_buku
    ];
}

    $nama_user = $_SESSION['nama_user'];
    $level = $_SESSION['level'];

header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>7Zip.Library - Books Catalog</title>
  
  <!-- Preload critical assets -->
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" as="style">
  <link rel="preload" href="style/styleindex.css" as="style">
  
  <!-- Load stylesheets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style/jawa.css">
  
  <!-- Add meta tags for SEO and performance -->
  <meta name="description" content="7Zip.Library - Your digital library catalog">
  <meta name="theme-color" content="#1e1e1e">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <style>
    body {
      background-attachment: fixed;
    }
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 2rem;
      padding: 2rem;
      justify-items: center;
    }
    .book-card {
      width: 300px;
      height: 420px;
      background: rgba(30, 30, 30, 0.95);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease, box-shadow 0.3s;
      border: 1.5px solid #333;
    }
    .book-card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 12px 32px 0 rgba(0,0,0,0.45);
    }
    .book-image {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      background: #222;
    }
    .book-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      padding: 1.2rem 1.2rem 1.2rem 1.2rem;
      color: white;
    }
    .book-title {
      font-size: 1.15rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      min-height: 2.5em;
      line-height: 1.2em;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    .book-description {
      font-size: 0.95rem;
      opacity: 0.9;
      min-height: 3.2em;
      max-height: 3.2em;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 0.5rem;
    }
    .book-author {
      font-size: 0.98rem;
      color: gold;
      margin-bottom: 0.2rem;
    }
    .book-category {
      font-size: 0.85rem;
      color: #aaa;
    }
    .page-title {
      color: white;
      text-align: center;
      margin: 2rem 0;
      font-weight: 600;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
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
    <a class="navbar-brand fw-bold text-white" href="landingsiswa.php">7Zip.Library</a>

    <!-- Navbar Toggler for Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarContent">


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

  <!-- Main Content -->
  <div class="container-fluid px-3 position-relative" style="min-height: 100vh; padding-top: 80px;">
    <img src="images/gmbr.webp" class="bg" alt="Background">
    <div class="position-relative" style="z-index: 1;">
      <h1 class="page-title">Book Catalog</h1>
      <!-- Filter Kategori -->
      <form method="GET" class="mb-4 d-flex justify-content-center">
        <select name="kategori" class="form-select w-auto bg-dark text-white" style="border-radius: 12px; font-size: 1.1rem; min-width: 220px;" onchange="this.form.submit()">
  <option value="all"<?= ($selected_kategori == 'all' || $selected_kategori == '') ? ' selected' : '' ?>>All Categories</option>
  <?php foreach($data_kategori as $kategori): ?>
    <option value="<?= htmlspecialchars($kategori['id_kategori']) ?>"<?= $selected_kategori == $kategori['id_kategori'] ? ' selected' : '' ?>>
      <?= htmlspecialchars($kategori['nama']) ?>
    </option>
  <?php endforeach; ?>
</select>

      </form>
      <section class="book-grid">
        <?php if (empty($data_buku)): ?>
          <div class="text-center text-white w-100">No books found in this category.</div>
        <?php else: ?>
          <?php foreach($data_buku as $info_buku): ?>
            <a href="detailbuku.php?id=<?= $info_buku['id_buku'] ?>" style="text-decoration:none" target="_self">
              <div class="book-card">
                <img class="book-image" 
                    src="<?= htmlspecialchars($info_buku['cover']); ?>" 
                    alt="<?= htmlspecialchars($info_buku['judul']); ?>" 
                    loading="lazy">

                <div class="book-info">
                  <div class="book-title"><?= htmlspecialchars($info_buku['judul']);?></div>
                  <div class="book-description mb-2"><?= htmlspecialchars($info_buku['deskripsi']);?></div>
                  <div class="book-author">by <?= htmlspecialchars($info_buku['pengarang']);?></div>
                  <div class="book-category">Category: <?= htmlspecialchars($info_buku['kategori_nama'] ?? $info_buku['id_kategori']);?></div>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </section>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer mt-5">
  </footer>

  <script>
    function confirmLogout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        window.location.href = 'logout.php';
      }
    }
  </script>
  <script>
  // Cek apakah user datang dari detail buku
  if (document.referrer.includes("detailbuku.php")) {
    // Replace books.php di history dengan landingsiswa.php
    history.replaceState(null, "", "landingsiswa.php");
    // Arahkan kembali ke books.php (tanpa reload history)
    window.location.href = "books.php";
  }
  
</script>

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
<!-- Move scripts to end of body and use defer -->
<script src="style/script.js" defer></script>
</body>
</html> 