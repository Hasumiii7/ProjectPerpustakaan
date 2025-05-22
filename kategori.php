<?php 
include 'config/controller.php';

$data_kategori = select("
  SELECT k.id_kategori, k.nama, COUNT(b.id_buku) AS total_buku 
  FROM kategori k 
  LEFT JOIN buku b ON k.id_kategori = b.id_kategori 
  GROUP BY k.id_kategori, k.nama
");

// Jika kategori dipilih
$selected_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : null;
$buku_by_kategori = [];
if ($selected_kategori) {
  $buku_by_kategori = select("SELECT b.*, k.nama as kategori_nama 
                             FROM buku b 
                             LEFT JOIN kategori k ON b.id_kategori = k.id_kategori 
                             WHERE k.nama = '" . mysqli_real_escape_string($db, $selected_kategori) . "'");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Categories - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="style/dark-theme.css" rel="stylesheet">
  <style>
    .main-container { backdrop-filter: none !important; }
    .navbar {
      background-color: #1a1a1a !important;
      padding: 1rem 0;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }
    .navbar .container-fluid {
      padding: 0 2rem;
    }
    .sidebar-books {
      background: #222;
      border-radius: 15px;
      padding: 24px;
      min-height: 400px;
      color: white;
    }
    .sidebar-books h2 {
      font-size: 1.3rem;
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <button type="button" class="btn btn-outline-light" onclick="window.location.href='landingadmin.php'">
        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
      </button>
      <div>
        <button type="button" class="btn btn-outline-light" onclick="window.location.href='tambahkategori.php'">
          <i class="fas fa-plus me-2"></i>Add Category
        </button>
      </div>
    </div>
  </nav>
  <div class="main-container container" style="padding-top: 120px;">
    <h1 class="page-title">Book Categories</h1><br><br><br><br>
    <div class="row">
      <div class="col-md-6">
        <!-- Category Table -->
        <div class="content-card mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table custom-table">
                <thead>
                  <tr>
                    <th style="width: 60px">No</th>
                    <th>Category Name</th>
                    <th style="width: 120px" class="text-center">Total Books</th>
                    <th style="width: 150px" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($data_kategori)): ?>
                    <tr>
                      <td colspan="4" class="text-center">No categories found</td>
                    </tr>
                  <?php else: ?>
                    <?php $no = 1; foreach($data_kategori as $kategori): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td>
                          <a href="?kategori=<?= urlencode($kategori['nama']) ?>" class="text-decoration-none text-white d-flex align-items-center<?= ($selected_kategori == $kategori['nama']) ? ' fw-bold' : '' ?>">
                            <i class="fas fa-bookmark me-2"></i>
                            <?= htmlspecialchars($kategori['nama']) ?>
                          </a>
                        </td>
                        <td class="text-center">
                          <span class="badge bg-primary"><?= $kategori['total_buku'] ?> books</span>
                        </td>
                        <td class="text-center">
                          <a href="ubahkategori.php?id_kategori=<?= $kategori['id_kategori'] ?>" class="btn btn-sm btn-outline-light btn-action me-1">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="hapuskategori.php?id_kategori=<?= $kategori['id_kategori'] ?>" 
                             class="btn btn-sm btn-outline-danger btn-action"
                             onclick="return confirm('Are you sure you want to delete this category?')">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <?php if ($selected_kategori): ?>
          <div class="sidebar-books">
            <h2><i class="fas fa-book me-2"></i>Books in <?= htmlspecialchars($selected_kategori) ?></h2>
            <?php if (empty($buku_by_kategori)): ?>
              <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h4>No Books Found</h4>
                <p class="text-muted">There are no books in this category yet.</p>
              </div>
            <?php else: ?>
              <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach($buku_by_kategori as $buku): ?>
                  <div class="col">
                    <div class="content-card h-100">
                      <div class="card-body">
                        <div class="row g-0">
                          <div class="col-auto">
                            <img src="<?= $buku['cover'] ?>" alt="Book cover" style="width: 100px; height: 150px; object-fit: cover; border-radius: 10px;">
                          </div>
                          <div class="col ps-3">
                            <h5 class="mb-2"><?= htmlspecialchars($buku['judul']) ?></h5>
                            <p class="text-muted mb-0" style="display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;">
                              <?= htmlspecialchars($buku['deskripsi']) ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>