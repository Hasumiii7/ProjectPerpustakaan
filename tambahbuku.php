<?php 
include 'config/controller.php';
$data_kategori = select("SELECT * FROM kategori");
if (isset($_POST['tambah'])) {
  if(create_buku($_POST) > 0){
    echo "<script>alert('Buku berhasil ditambah');document.location.href='tablebuku.php';</script>";
  } else {
    echo "<script>alert('Buku gagal ditambah');document.location.href='tablebuku.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1>Tambah Buku</h1>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" name="judul" id="judul" required>
      </div>
      <div class="mb-3">
        <label for="pengarang" class="form-label">Pengarang</label>
        <input type="text" class="form-control" name="pengarang" id="pengarang" required>
      </div>
      <div class="mb-3">
        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
        <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit" required>
      </div>
      <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" name="jumlah" id="jumlah" required>
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
      </div>
      <div class="mb-3">
        <label for="url" class="form-label">URL</label>
        <input type="text" class="form-control" name="url" id="url">
      </div>
      <div class="mb-3">
        <label for="cover" class="form-label">Cover (URL gambar)</label>
        <input type="text" class="form-control" name="cover" id="cover">
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Kategori</label>
        <select class="form-control" name="nama" id="nama" required>
          <option value="">Pilih Kategori</option>
          <?php foreach($data_kategori as $kategori): ?>
            <option value="<?= htmlspecialchars($kategori['nama']) ?>"><?= htmlspecialchars($kategori['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="tambah">Tambah Buku</button>
    </form>
  </div>
</body>
</html>
 