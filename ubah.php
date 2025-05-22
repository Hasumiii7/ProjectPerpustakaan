<?php
include("config/controller.php");

// Mengambil id produk
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $login = select("SELECT * FROM login WHERE id=$id")[0];

    if (isset($_POST['ubah'])) {
        if (edit_account($_POST) > 0) {
            echo "<script>
            alert('Data Berhasil Di Update'); 
            document.location.href='tableadmin.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Di Update'); 
            document.location.href='tableadmin.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Akun</title>
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
        padding: 40px 32px;
        max-width: 500px;
        margin: 0 auto;
      }
      .form-label, h1, label, .btn {
        color: white !important;
      }
      .btn-back {
        margin-bottom: 1.5rem;
      }
      select.form-select {
      background-color: #1e1e1e;
      color: white;
      border: 1px solid #ced4da;
      }

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="content-card">
        <!-- <button type="button" class="btn btn-outline-light btn-back" onclick="window.location.href='tableadmin.php'">
          <i class="fas fa-arrow-left me-2"></i>Back to Table
        </button> -->
        <h1 class="text-center mb-4" style="font-weight:500; color:white">EDIT DATA</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $login['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $login['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $login['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" id="password" value="<?= $login['password']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover Image</label>
                <input type="file" class="form-control" name="cover" id="cover" accept="image/*">
                <?php if (!empty($login['cover'])): ?>
                    <div class="mt-2">
                        <img src="<?= $login['cover']; ?>" alt="Current Cover" style="max-width: 200px; max-height: 200px;">
                    </div>
                <?php endif; ?>
            </div>
            <div class="row mb-3">
    <div class="col">
        <label for="level" class="form-label">Level</label>
        <select class="form-select" name="level" id="level" required>
            <option value="admin" <?= $login['level'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="petugas" <?= $login['level'] == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
            <option value="siswa" <?= $login['level'] == 'siswa' ? 'selected' : ''; ?>>Siswa</option>
        </select>
    </div>
    <div class="col">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status" required>
            <option value="aktif" <?= $login['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
            <option value="tidak aktif" <?= $login['status'] == 'tidak aktif' ? 'selected' : ''; ?>>Nonaktif</option>
        </select>
    </div>
</div>


            <button class="btn btn-outline-light w-100" type="submit" name="ubah" value="Simpan" style="padding: 15px 30px; border-radius:10px">Update</button>
        </form>
      </div>
    </div>
</body>
</html>
