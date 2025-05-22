<?php
    include 'config/controller.php';
    //menerima id produk yang dipilih untuk dihapu
    $id = (int)$_GET['id'];

    //kondisi ketika tombol hapus di klik
    if (delete_account($id) > 0){
        echo "<script>
      alert('Data Berhasil Di Hapus'); 
      document.location.href='tableadmin.php';
      </script>";
    } else {
        echo "<script>
      alert('Data Gagal Di Update'); 
      document.location.href='tableadmin.php';
      </script>";
    }

    