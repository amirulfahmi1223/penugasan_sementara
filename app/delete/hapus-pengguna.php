<?php
session_start();
include '../../connection/koneksi.php';

error_reporting(0);
if ($_GET['id'] == "") {
  echo "<script>window.location='../pengguna.php'</script>";
}
if (isset($_GET['id'])) {
  $data = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE id ='" . $_GET['id'] . "' ");
  //mengecek data di table
  if (mysqli_num_rows($data) > 0) {
    $valid = "SELECT * FROM tb_pengguna WHERE id = '" . $_COOKIE['id'] . "'";
    $v = mysqli_fetch_object(mysqli_query($conn, $valid));
    if ($v->level == "Member" || $v->level == "Leader") {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>window.location="../pengguna.php"</script>';
    }
    $d = mysqli_fetch_object($data);
    if ($d->level == 'Administrator') {
      $_SESSION['info'] = 'Level Administator Tidak dapat diHapus!';
      echo "<script>window.location='../pengguna.php'</script>";
      return false;
    }
    //mengecek data difolder
    if (file_exists("../../uploads/profil/" . $d->logo) && $d->logo != "new-default.png") {
      //jika ada difolder jurusan maka lakukan proses hapus file
      unlink("../../uploads/profil/" . $d->logo);
    }
    $val = mysqli_query($conn, "SELECT * FROM tb_projek WHERE created_by = '" . $_GET['id'] . "'");
    if (mysqli_num_rows($val) > 0) {
      $query = "DELETE tb_pengguna,tb_projek FROM tb_pengguna
      INNER JOIN tb_projek ON tb_pengguna.id=tb_projek.created_by
      WHERE tb_projek.created_by = '" . $_GET['id'] . "'";
      mysqli_query($conn, $query);
      //cek data blokir
      $val_blokir = mysqli_query($conn, "SELECT * FROM tb_blokir WHERE id_pengguna = '" . $_GET['id'] . "'");
      if (mysqli_num_rows($val_blokir) > 0) {
        $delete_blokir = mysqli_query($conn, "DELETE FROM tb_blokir WHERE id_pengguna = '" . $_GET['id'] . "'");
      }
    } else {
      $query = "DELETE FROM tb_pengguna
      WHERE id = '" . $_GET['id'] . "'";
    }
    $delete = mysqli_query($conn, $query);
    if ($delete) {
      $_SESSION['info'] = 'Data Berhasil diHapus';
      echo "<script>window.location='../pengguna.php'</script>";
    } else {
      $_SESSION['info'] = 'Data Gagal diHapus';
      echo "<script>window.location='../pengguna.php'</script>";
    }
  }
  echo "<script>window.location='../pengguna.php'</script>";
}
