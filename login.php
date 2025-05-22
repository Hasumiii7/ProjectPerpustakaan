<?php 
include 'config/controller.php';
session_start(); // WAJIB untuk pakai $_SESSION

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $query = "SELECT * FROM login WHERE username = '$username'";
    $user = select($query);

    if (!empty($user)) {
        // Cek password
        if ($user[0]['password'] === $password) {
            // Simpan nama atau username ke session
            $_SESSION['nama_user'] = $user[0]['name']; // atau pakai ['username'] jika ingin username

            // Ambil status user
            $level = $user[0]['level'];
            
            // Redirect berdasarkan status
            switch ($level) {
                case 'admin':
                    header("Location: landingadmin.php");
                    exit;
                case 'petugas':
                    header("Location: landingpetugas.php");
                    exit;
                case 'siswa':
                    header("Location: landingsiswa.php");
                    exit;
                default:
                    echo "<script>alert('Status tidak valid!');</script>";
                    break;
            }
        } else {
            echo "<script>alert('Password Wrong!');</script>";
        }
    } else {
        echo "<script>alert('Username not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style/dark-theme.css" rel="stylesheet">
    <style>
      body { min-height: 100vh; }
      .main-container { backdrop-filter: none !important; }
      .navbar {
    /* background-color: #1a1a1a !important; */
    padding: 1rem 0;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    font-family: Montserrat;
  }
    </style>
</head>
<body style="background-image: url(images/gmbr.webp); background-size: cover; background-position: center; background-attachment:fixed;">
    <nav class="navbar navbar-expand-lg" >
      <div class="container-fluid">
        <a class="navbar-brand fw-bold text-white" href="index.php">7Zip.Library</a>
        <div class="ms-auto d-flex align-items-center"></div>
      </div>
    </nav>
    <div class="main-container container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 80px;">
        <div class="content-card p-5" style="max-width: 400px; width: 100%; border-radius: 20px;">
            <h1 class="text-center mb-4" style="font-weight:500; color:white">LOGIN</h1>
            <form action="" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label text-white">Username</label>
                  <input class="form-control" type="text" name="username" id="username" required>
                </div>
                <div class="mb-4">
                  <label for="password" class="form-label text-white">Password</label>
                  <input class="form-control" type="password" name="password" id="password" required>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-light" type="submit" name="login" style="padding: 15px 30px; border-radius:10px">Login</button>
                </div>
                <div class="text-center mt-3">
                  <a href="tambahsiswa.php" class="text-white" style="text-decoration: none;">Register Here!</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
