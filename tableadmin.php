<?php 
include 'config/controller.php';
// Get filter value from URL parameter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Modify SQL query based on filter
if ($filter == 'all') {
    $data_login = select("SELECT * FROM login");
} else {
    $data_login = select("SELECT * FROM login WHERE level = '$filter'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acc Management | Admin</title>
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
  </style>
</head>
<body style="background-image: url(images/gmbr.webp); background-size: 100% 100%; background-attachment:fixed; opacity:100%; ">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <button type="button" class="btn btn-outline-light" onclick="window.location.href='landingadmin.php'">
        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
      </button>
      <div class="d-flex gap-2">
        <select class="form-select bg-dark text-light" onchange="window.location.href='tableadmin.php?filter=' + this.value">
          <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Accounts</option>
          <option value="admin" <?= $filter == 'admin' ? 'selected' : '' ?>>Admin</option>
          <option value="petugas" <?= $filter == 'petugas' ? 'selected' : '' ?>>Petugas</option>
          <option value="siswa" <?= $filter == 'siswa' ? 'selected' : '' ?>>Siswa</option>
        </select>
        <button type="button" class="btn btn-outline-light" onclick="window.location.href='regisadmin.php'">
          <i class="fas fa-plus me-2"></i>Add Account
        </button>
      </div>
    </div>
  </nav>
  <div class="main-container container" style="padding-top: 80px;">
    <h1 class="page-title">ACCOUNT DATA</h1>
    <div class="content-card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table custom-table">
            <thead>
              <tr style="color:white; ">
                <th>No.</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Status</th>
                <th class="text-center" style="width: 120px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;?>
              <?php foreach($data_login as $login): ?>
                <tr style="color:white;">
                <td><?=$no++; ?></td>
                <td><?=$login['name']; ?></td>
                <td><?=$login['username']; ?></td>
                <td><?=$login['password']; ?></td>
                <td><?=$login['level']; ?></td>
                <td><?=$login['status']; ?></td>
                <td class="text-center">
                  <a href="ubah.php?id=<?= $login['id']; ?>" class="btn btn-sm btn-outline-light btn-action me-1">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="hapus.php?id=<?= $login['id']; ?>" class="btn btn-sm btn-outline-danger btn-action" onclick="return confirm('Are you sure you want to delete this account?')">
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
</body>
</html>