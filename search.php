<?php
// Koneksi ke database
$host = "localhost"; 
$user = "root";      
$pass = "";          
$dbname = "db_perpus"; 

$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap query pencarian
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : "";

// Query untuk mencari buku berdasarkan judul atau deskripsi
$sql = "SELECT * FROM buku WHERE judul LIKE '%$query%' OR deskripsi LIKE '%$query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
  body {
    background-image: url('images/gmbr.webp');
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    font-family: 'Montserrat', sans-serif;
    color: white;
    margin: 0;
    padding-bottom: 3rem;
  }

  .container {
    margin-top: 6rem;
    max-width: 960px;
    background-color: rgba(30, 30, 30, 0.85);
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
  }

  h2.text-center {
    font-weight: 600;
    margin-bottom: 2rem;
  }

  .card-hover {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    background-color: rgba(40, 40, 40, 0.8);
    border-radius: 15px;
    padding: 1rem 1.5rem;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
  }

  .card-hover:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 24px rgba(255, 215, 0, 0.7);
    background-color: rgba(50, 50, 50, 0.9);
  }

  .cover-img {
    width: 120px;
    height: 180px;
    border-radius: 12px;
    object-fit: cover;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.7);
  }

  .card-content {
    flex: 1;
  }

  .card-content h5 {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: gold;
  }

  .card-content p {
    font-size: 0.9rem;
    color: #ddd;
  }

  .no-results {
    text-align: center;
    font-size: 1.2rem;
    margin-top: 3rem;
    color: #ccc;
  }

  /* Button Kembali */
  .button-kembali {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1001;
  }
</style>

</head>
<body>
    <div class="container">
  <h2 class="text-center">Hasil Pencarian untuk: "<?php echo htmlspecialchars($query); ?>"</h2>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card-hover p-3 d-flex align-items-center" onclick="window.location.href='detailbuku.php?id=<?php echo $row['id_buku']; ?>'">
        <img src="<?php echo $row['cover']; ?>" alt="<?php echo $row['judul']; ?>" class="cover-img" />
        <div class="card-content">
          <h5><?php echo $row['judul']; ?></h5>
          <p><?php echo $row['deskripsi']; ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="no-results">Tidak ada hasil yang ditemukan.</p>
  <?php endif; ?>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
