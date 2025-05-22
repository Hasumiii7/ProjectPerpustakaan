<?php

include 'config/controller.php';
// menerima id buku yang dipilih untuk dihapus
$id_buku = isset($_GET['id_buku']) ? (int)$_GET['id_buku'] : 0;

if ($id_buku && delete_buku($id_buku) > 0) {
    echo "<script>alert('Data Berhasil Di Hapus');document.location.href='tablebuku.php';</script>";
} else {
    echo "<script>alert('Data Gagal Di Hapus');document.location.href='tablebuku.php';</script>";
}