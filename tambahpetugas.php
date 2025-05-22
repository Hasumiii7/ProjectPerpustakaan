<?php
  include("config/controller.php");
  if (isset($_POST['tambah'])) {
    if(create_account($_POST) > 0){
    echo"<script>
    alert('Data berhasil ditambah');
    document.location.href='tablepetugas.php';
    </script>";
    }else{
      echo"<script>
    alert('Data tidak berhasil ditambahkan');
    document.location.href='tablepetugas.php';
    </script>";
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Account | Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style/dark-theme.css" rel="stylesheet">
    <style>
      body { min-height: 100vh; }
      .main-container { backdrop-filter: none !important; 
      }
      select.form-select {
      background-color: #1e1e1e;
      color: white;
      border: 1px solid #ced4da;
      }

    </style>
  </head>
  <body style="background-image: url(images/gmbr.webp); background-size: cover; background-position: center; background-attachment:fixed;">
    <nav class="navbar navbar-dark mb-4 px-0">
      <div class="d-flex justify-content-between w-100 px-4">
        <button type="button" class="btn btn-outline-light" onclick="window.location.href='tablepetugas.php'">
          <i class="fas fa-arrow-left me-2"></i>Back to Account Table
        </button>
      </div>
    </nav>
    <div class="main-container container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
      <div class="content-card p-5" style="max-width: 500px; width: 100%; border-radius: 20px;">
        <h1 class="text-center mb-4" style="font-weight:500; color:white">REGISTER</h1>
        <form action="" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label text-white">Name</label>
            <input class="form-control" type="text" name="name" id="name" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label text-white">Username</label>
            <input class="form-control" type="text" name="username" id="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label text-white">Password</label>
            <input class="form-control" type="text" name="password" id="password" required>
          </div>
          
          <!-- <div class="row mb-4">
            <div class="col">
              <label for="level" class="form-label text-white">Level</label>
              <input class="form-control" type="text" name="level" id="level" required>
            </div>
            <div class="col">
              <label for="status" class="form-label text-white">Status</label>
              <input class="form-control" type="text" name="status" id="status" required>
            </div>
          </div> -->

            <div class="row mb-3">
                <div hidden class="col">
                    <label for="level" class="form-label">Level</label>
                    <select hidden class="form-select" name="level" id="level">
                        <option value="siswa" >Siswa</option>
                    </select>
                </div>
                <div hidden class="col">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status">
                        <option value="aktif" >Aktif</option>
                    </select>
                </div>
            </div>
          <div class="d-grid">
            <button class="btn btn-outline-light" type="submit" name="tambah" value="Simpan" style="padding: 15px 30px; border-radius:10px">Register</button>
          </div>
        </form>
      </div>
    </div>
  </body>
  </html>