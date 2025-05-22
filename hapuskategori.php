<?php
include 'config/controller.php';
$id_kategori = isset($_GET['id_kategori']) ? (int)$_GET['id_kategori'] : 0;

if ($id_kategori && delete_kategori($id_kategori) > 0) {
    echo "<script>alert('Kategori berhasil dihapus');document.location.href='kategori.php';</script>";
} else {
    echo "<script>alert('Kategori gagal dihapus');document.location.href='kategori.php';</script>";
} 