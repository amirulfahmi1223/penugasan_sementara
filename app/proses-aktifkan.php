<?php
session_start();
include '../connection/koneksi.php';
error_reporting(0);
if ($_GET['id'] == "") {
  echo "<script>window.location='daftar-blokir.php'</script>";
}
if (isset($_GET['id'])) {
  $data = mysqli_query($conn, "SELECT * FROM tb_blokir WHERE id = '" . $_GET['id'] . "'");

  //mengecek data di table
  if (mysqli_num_rows($data) > 0) {
    $val = "SELECT * FROM tb_pengguna WHERE id = '" . $_COOKIE['id'] . "'";
    $v = mysqli_fetch_object(mysqli_query($conn, $val));
    if ($v->level == "Member" || $v->level == "Leader") {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>window.location="daftar-blokir.php"</script>';
    }
    $query = "DELETE FROM tb_blokir WHERE id = '" . $_GET['id'] . "'";
    $delete = mysqli_query($conn, $query);
    if ($delete) {
      $_SESSION['info'] = 'Aktivasi Pengguna Berhasil';
      echo "<script>window.location='daftar-blokir.php'</script>";
    } else {
      $_SESSION['info'] = 'Aktivasi Pengguna Gagal';
      echo "<script>window.location='daftar-blokir.php'</script>";
    }
  }
  echo "<script>window.location='daftar-blokir.php'</script>";
}
