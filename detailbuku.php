<?php 
include 'config/controller.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "ID buku tidak valid.";
  exit;
}

$id = (int)$_GET['id'];
$buku = select("SELECT * FROM buku WHERE id_buku = $id");

if (empty($buku)) {
  echo "Buku tidak ditemukan.";
  exit;
}

$buku = $buku[0];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Buku - <?= htmlspecialchars($buku['judul']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1c1c1c;
      color: #f1f1f1;
      font-family: 'Segoe UI', sans-serif;
      padding-top: 60px;
    }
    .detail-container {
      max-width: 1000px;
      margin: auto;
      background-color: #2a2a2a;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.6);
      overflow: hidden;
    }
    .cover-col {
      background-color: #1f1f1f;
      padding: 1rem;
      text-align: center;
    }
    .cover-col img {
      max-width: 100%;
      border-radius: 10px;
    }
    .info-col {
      padding: 2rem;
    }
    .info-col h2 {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }
    .info-col p {
      margin: 0.3rem 0;
    }
    .url-btn {
      margin-top: 1rem;
    }
  </style>
</head>
<body>

<div class="container detail-container d-flex flex-wrap">
  <div class="col-md-4 cover-col">
    <img src="<?= htmlspecialchars($buku['cover']) ?>" alt="Cover Buku">
  </div>

  <div class="col-md-8 info-col">
    <h2><?= htmlspecialchars($buku['judul']) ?></h2>
    <p><strong>Pengarang:</strong> <?= htmlspecialchars($buku['pengarang']) ?></p>
    <p><strong>Kategori:</strong> <?= htmlspecialchars($buku['id_kategori']) ?></p>
    <p><strong>Tahun Terbit:</strong> <?= htmlspecialchars($buku['tahun_terbit']) ?></p>
    <p><strong>Jumlah Tersedia:</strong> <?= htmlspecialchars($buku['jumlah']) ?></p>
    <p class="mt-3"><?= nl2br(htmlspecialchars($buku['deskripsi'])) ?></p>
    
    <?php if ($buku['url'] !== '#'): ?>
      <a href="<?= htmlspecialchars($buku['url']) ?>" target="_blank" class="btn btn-success url-btn">🔗 Lihat Buku</a>
    <?php endif; ?>


  </div>
</div>

</body>
</html>
