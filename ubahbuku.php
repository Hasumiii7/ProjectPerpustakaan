<?php
include("config/controller.php");

// Ambil data buku berdasarkan id_buku
if (isset($_GET['id_buku'])) {
    $id_buku = (int)$_GET['id_buku'];
    $cover = isset($data['cover']) ? mysqli_real_escape_string($db, $data['cover']) : '';
    $buku = select("SELECT * FROM buku WHERE id_buku=$id_buku");
    if ($buku) {
        $buku = $buku[0];
    } else {
        echo "<script>alert('Buku tidak ditemukan');document.location.href='tablebuku.php';</script>";
        exit;
    }
    $data_kategori = select("SELECT * FROM kategori");

    if (isset($_POST['ubah'])) {
        $_POST['id_buku'] = $id_buku;
        if (edit_buku($_POST) > 0) {
            echo "<script>alert('Data Berhasil Di Update');document.location.href='tablebuku.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Di Update');document.location.href='tablebuku.php';</script>";
        }
    }
} else {
    echo "<script>alert('ID Buku tidak ditemukan');document.location.href='tablebuku.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/dark-theme.css">
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
        padding: 40px 32px;
        /* max-width: 500px; */
        width: 50%;
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
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 24px;">
      <div class="content-card">
        <h1 class="text-center mb-4" style="font-weight:500; color:white">Edit Buku</h1><br><br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required>
            </div><br>
            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= htmlspecialchars($buku['pengarang']) ?>" required>
            </div><br>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= htmlspecialchars($buku['tahun_terbit']) ?>" required>
            </div><br>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= htmlspecialchars($buku['jumlah']) ?>" required>
            </div><br>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" required><?= htmlspecialchars($buku['deskripsi']) ?></textarea>
            </div><br>
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" name="url" id="url" value="<?= htmlspecialchars($buku['url']) ?>">
            </div><br>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover</label>
                <input type="text" class="form-control" name="cover" id="cover" value="<?= htmlspecialchars($buku['cover']) ?>">
            </div><br>
            <div class="mb-3">
                <label for="nama" class="form-label">Kategori</label>
                <select class="form-control" name="nama" id="nama" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach($data_kategori as $kategori): ?>
                        <option value="<?= htmlspecialchars($kategori['nama']) ?>" <?= $buku['nama'] == $kategori['nama'] ? 'selected' : '' ?>><?= htmlspecialchars($kategori['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br><br>
            <button type="submit" class="btn btn-outline-light w-100" name="ubah" style="padding: 15px 30px; border-radius:10px">Update Buku</button>
        </form>
      </div>
    </div>
</body>
</html>
