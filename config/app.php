<?php
//panggil koneksi database
include("koneksi.php");

//fungsi select
function select($query) {
  global $db;
  $result = mysqli_query($db, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

//fungsi tambah user
function create_account($post) {
  global $db;
  $name = strip_tags($post['name']);
  $username = strip_tags($post['username']);
  $password = strip_tags($post['password']);
  $level = strip_tags($post['level']);
  $status = strip_tags($post['status']);

  $query = "INSERT INTO login VALUES (null,'$name','$username','$password','$level','$status')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi ubah user
function edit_account($post){
  global $db;
  $id = $post['id'];
  $name = $post['name'];
  $username = $post['username'];
  $password = $post['password'];
  $level = $post['level'];
  $status = $post['status'];

  $query = "UPDATE login SET name='$name', username='$username', password='$password', level='$level', status='$status' WHERE id=$id";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi hapus user
function delete_account($id){
  global $db;
  $query = "DELETE FROM login WHERE id=$id";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi hapus kategori
function delete_kategori($id_kategori){
  global $db;
  $query = "DELETE FROM kategori WHERE id_kategori=$id_kategori";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi tambah kategori
function create_kategori($post) {
  global $db;
  $nama = strip_tags($post['nama']);

  $query = "INSERT INTO kategori VALUES (null,'$nama')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi ubah kategori
function edit_kategori($post){
  global $db;
  $id_kategori = $post['id_kategori'];
  $nama = $post['nama'];

  $query = "UPDATE kategori SET nama='$nama' WHERE id_kategori=$id_kategori";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi tambah buku
function create_buku($post) {
  global $db;
  $judul = strip_tags($post['judul']);
  $pengarang = strip_tags($post['pengarang']);
  $tahun_terbit = strip_tags($post['tahun_terbit']);
  $jumlah = (int)$post['jumlah'];
  $deskripsi = strip_tags($post['deskripsi']);
  $url = strip_tags($post['url']);
  $cover = strip_tags($post['cover']);
  $id_kategori = strip_tags($post['id_kategori']); // kategori buku

  $query = "INSERT INTO buku (judul, pengarang, tahun_terbit, jumlah, deskripsi, url, cover, nama) VALUES ('$judul', '$pengarang', '$tahun_terbit', $jumlah, '$deskripsi', '$url', '$cover', '$id_kategori')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

//fungsi ubah buku
// function edit_buku($post) {
//   global $db;
//   $id_buku = isset($post['id_buku']) ? $post['id_buku'] : 0;
//   $judul = isset($post['judul']) ? strip_tags($post['judul']) : '';
//   $pengarang = isset($post['pengarang']) ? strip_tags($post['pengarang']) : '';
//   $tahun_terbit = isset($post['tahun_terbit']) ? strip_tags($post['tahun_terbit']) : '';
//   $jumlah = isset($post['jumlah']) ? (int)$post['jumlah'] : 0;
//   $deskripsi = isset($post['deskripsi']) ? strip_tags($post['deskripsi']) : '';
//   $url = isset($post['url']) ? strip_tags($post['url']) : '';
//   $cover = isset($post['cover']) ? strip_tags($post['cover']) : '';
//   $nama = isset($post['nama']) ? strip_tags($post['nama']) : '';

//   $query = "UPDATE buku SET judul='$judul', pengarang='$pengarang', tahun_terbit='$tahun_terbit', jumlah=$jumlah, deskripsi='$deskripsi', url='$url', cover='$cover', nama='$nama' WHERE id_buku=$id_buku";
//   mysqli_query($db, $query);
//   return mysqli_affected_rows($db);
// }

//fungsi hapus buku
function edit_buku($data) {
    global $db;

    if (!isset($data['id_buku']) || empty($data['id_buku'])) {
        echo "Error: id_buku tidak ada atau kosong.";
        return -1;
    }

    $id = (int)$data['id_buku']; // pastikan integer
    $judul = mysqli_real_escape_string($db, $data['judul']);
    $pengarang = mysqli_real_escape_string($db, $data['pengarang']);
    $tahun_terbit = mysqli_real_escape_string($db, $data['tahun_terbit']);
    $jumlah = (int)$data['jumlah'];
    $deskripsi = mysqli_real_escape_string($db, $data['deskripsi']);
    $url = mysqli_real_escape_string($db, $data['url']);
    $cover = mysqli_real_escape_string($db, $data['cover']);
    $id_kategori = mysqli_real_escape_string($db, $data['id_kategori']);

    $query = "UPDATE buku SET
        judul='$judul',
        pengarang='$pengarang',
        tahun_terbit='$tahun_terbit',
        jumlah=$jumlah,
        deskripsi='$deskripsi',
        url='$url',
        cover='$cover',
        id_kategori='$id_kategori'
        WHERE id_buku=$id";

    echo "<pre>$query</pre>"; // debug: lihat query

    $result = mysqli_query($db, $query);

    if (!$result) {
        echo "Error MySQL: " . mysqli_error($db);
        return -1;
    }

    return mysqli_affected_rows($db);
}
