<?php 
include 'config/controller.php';
$data_buku = select("SELECT buku.*, kategori.nama AS nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>7Zip.Library - Books Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="style/jawa.css">
  <style>
    .table {
      color: white;
      width: 100% !important;
      max-width: 100% !important;
      border-radius: 10px;
    }
    .table thead th {
      border-color: rgba(255, 255, 255, 0.2);
      background-color: #101010;
      color: white;
      padding: 15px;
    }
    .table td {
      border-color: rgba(255, 255, 255, 0.1);
      background-color:rgb(44, 44, 44);
      color: white;
      padding: 10px;
    }
    .btn-action {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
    }
    .page-title {
      color: white;
      font-weight: 600;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    .table-responsive {
      width: 100% !important;
      max-width: 100% !important;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white" href="#">7Zip.Library</a>
      <div class="ms-auto d-flex align-items-center">
        
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container-fluid px-3 position-relative" style="min-height: 100vh;">
    <img src="images/gmbr.webp" class="bg" alt="#">
    <div class="position-relative" style="z-index: 1;">
      <div class="container-fluid py-4" style="padding-left:32px; padding-right:32px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="page-title m-0">Books Management</h1>
          <a href="tambahbuku.php" class="btn btn-outline-light">
            <i class="fas fa-plus"></i> Add New Book
          </a>
        </div>
        
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Release Date</th>
                <th>Stock</th>
                <th>Description</th>
                <th>URL</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach($data_buku as $buku): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td>
                  <img src="<?= $buku['cover'] ?>" alt="Cover" style="width: 50px; height: 70px; object-fit: cover;">
                  </td>
                <td><?= htmlspecialchars($buku['judul']) ?></td>
                <td><?= htmlspecialchars($buku['nama_kategori']) ?></td>
                <td><?= htmlspecialchars($buku['pengarang']) ?></td>
                <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
                <td><?= htmlspecialchars($buku['jumlah']) ?></td>
                <td><?= htmlspecialchars($buku['deskripsi']) ?></td>
                <td><a href="<?= htmlspecialchars($buku['url']) ?>" target="_blank" style="color:white;word-break:break-all;"><i class="fas fa-eye"></i></a></td>
                <td>
                  <a href="ubahbuku.php?id_buku=<?= $buku['id_buku'] ?>" class="btn btn-outline-light btn-action me-2">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="hapusbuku.php?id_buku=<?= $buku['id_buku'] ?>" class="btn btn-outline-danger btn-action" 
                     onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
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