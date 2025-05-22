<?php
include 'config/controller.php';

// Ambil data kategori berdasarkan id_kategori
if (isset($_GET['id_kategori'])) {
    $id_kategori = (int)$_GET['id_kategori'];
    $kategori = select("SELECT * FROM kategori WHERE id_kategori=$id_kategori");
    if ($kategori) {
        $kategori = $kategori[0];
    } else {
        echo "<script>alert('Kategori tidak ditemukan');document.location.href='kategori.php';</script>";
        exit;
    }
    if (isset($_POST['ubah'])) {
        $_POST['id_kategori'] = $id_kategori;
        if (edit_kategori($_POST) > 0) {
            echo "<script>alert('Kategori berhasil diupdate');document.location.href='kategori.php';</script>";
        } else {
            echo "<script>alert('Kategori gagal diupdate');document.location.href='kategori.php';</script>";
        }
    }
} else {
    echo "<script>alert('ID Kategori tidak ditemukan');document.location.href='kategori.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/dark-theme.css" rel="stylesheet">
    <style>
      body {
        background-image: url('images/gmbr.webp');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
      }
      .content-card {
        background: rgba(30,30,30,0.95);
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
        padding: 50px 50px;
        max-width: 650px;
        margin: 0 auto;
      }
      .form-label, h1, label, .btn {
        color: white !important;
      }
      .btn-back {
        margin-bottom: 2rem;
        font-size: 1.1rem;
        padding: 12px 28px;
      }
      h1 {
        font-size: 2.5rem;
        font-weight: 700;
      }
      .form-control, input[type="text"] {
        background: #222 !important;
        color: #fff !important;
        border: 1.5px solid #444;
        border-radius: 12px;
        font-size: 1.1rem;
        padding: 14px 20px;
        margin-bottom: 10px;
      }
      .form-control:focus, input[type="text"]:focus {
        background: #222 !important;
        color: #fff !important;
        border-color: #888;
        box-shadow: 0 0 0 2px #444;
      }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="content-card">
        <!-- <button type="button" class="btn btn-outline-light btn-back" onclick="window.location.href='kategori.php'">
          <i class="fas fa-arrow-left me-2"></i>Back to Categories
        </button> -->
        <h1 class="text-center mb-4" style="font-weight:500; color:white">Edit Kategori</h1><br><br><br>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= htmlspecialchars($kategori['nama']) ?>" required>
            </div><br><br>
            <button type="submit" class="btn btn-outline-light w-100" name="ubah" style="padding: 15px 30px; border-radius:10px">Update Kategori</button>
        </form>
      </div>
    </div>
</body>
</html> 