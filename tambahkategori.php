<?php
  include("config/controller.php");
  if (isset($_POST['tambahkategori'])) {
    if(create_kategori($_POST) > 0){
    echo"<script>
    alert('Data berhasil ditambah');
    document.location.href='kategori.php';
    </script>";
    }else{
      echo"<script>
    alert('Data tidak berhasil ditambahkan');
    document.location.href='tambahkategori.php';
    </script>";
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <!-- <link rel="stylesheet" href="style/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
    <div class="kontener" style="background-image: url(images/gmbr.webp);  width:100vw; height:100vh; background-size: cover; background-position: center; opacity:95%">
    <button type="button" class="btn btn-outline-light" onclick="window.location.href='kategori.php'" style="margin: 5em;">Back</button>
  <div class="card position-absolute top-50 start-50 translate-middle shadow bg-transparent" style="border-radius: 30px; padding: 60px 200px 60px 200px; backdrop-filter: blur(11px); ">
    <h1 style="text-align: center; padding-bottom:30px; font-weight:500; color:white">INSERT BOOK CATEGORY</h1>
    <form action="" method="POST">
    <label for="" style="color:white">Book Category</label><br>
    <input class="form-control" type="text" name="nama" style="padding:5px 30px" required>
    <br>

    
   
    <!-- <div style="display: flex; gap: 50px; align-items: center;">
    <div>
      <label for="level" style="color:white">Level</label><br>
      <input class="form-control" type="number" name="level" style="padding: 5px; width: 100px;" required>
    </div>
    <div>
      <label for="status" style="color:white">Status</label><br>
      <input class="form-control" type="text" name="status" style="padding: 5px; width: 100px;" required>
    </div>
  </div>
  <br>
  <br> -->


    <!-- <input type="submit" name="tambah" value="Simpan" class="btn btn-dark" > -->
    <div class="d-grid gap-2 col-15 mx-auto">
    <button class="btn btn-outline-light" type="submit" name="tambahkategori" value="Simpan" style="padding: 15px 30px; width: 100%; border-radius:10px">Add Category</button>
  </div>

    </form>
  </div>
  </div>
  </body>
  </html>