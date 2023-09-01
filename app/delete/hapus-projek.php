<?php
session_start();
include '../../connection/koneksi.php';
error_reporting(0);
if ($_GET['kode'] == "") {
  echo "<script>window.location='../projek.php'</script>";
}
if (isset($_GET['kode'])) {
  $data = mysqli_query($conn, "SELECT * FROM tb_projek WHERE kode_projek ='" . $_GET['kode'] . "' ");
  //mengecek data di table
  if (mysqli_num_rows($data) > 0) {
    $val = "SELECT * FROM tb_pengguna WHERE id = '" . $_COOKIE['id'] . "'";
    $v = mysqli_fetch_object(mysqli_query($conn, $val));
    if ($v->level == "Member" || $v->level == "Leader") {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>window.location="../projek.php"</script>';
    }
    //cek data blokir
    $val_blokir = mysqli_query($conn, "SELECT * FROM tb_blokir WHERE kd_projek = '" . $_GET['kode'] . "'");
    if (mysqli_num_rows($val_blokir) > 0) {
      $query = "DELETE tb_projek,tb_blokir FROM tb_projek
      INNER JOIN tb_blokir ON tb_projek.kode_projek=tb_blokir.kd_projek
      WHERE tb_projek.kode_projek = '" . $_GET['kode'] . "'";
    } else {
      $query = "DELETE FROM tb_projek WHERE kode_projek = '" . $_GET['kode'] . "'";
    }
    $delete = mysqli_query($conn, $query);
    if ($delete) {
      $_SESSION['info'] = 'Data Berhasil diHapus';
      echo "<script>window.location='../projek.php'</script>";
    } else {
      $_SESSION['info'] = 'Data Gagal diHapus';
      echo "<script>window.location='../projek.php'</script>";
    }
  }
  echo "<script>window.location='../projek.php'</script>";
}
