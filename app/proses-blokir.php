<?php
session_start();
include '../../connection/koneksi.php';
error_reporting(0);
if ($_POST['kode'] == "") {
  echo "<script>window.location='projek.php'</script>";
}
if (isset($_POST['kode'])) {
  $data = mysqli_query($conn, "SELECT * FROM tb_projek WHERE kode_projek ='" . $_POST['kode'] . "' ");
  //mengecek data di table
  if (mysqli_num_rows($data) > 0) {
    $valid = "SELECT * FROM tb_pengguna WHERE id = '" . $_COOKIE['id'] . "'";
    $v = mysqli_fetch_object(mysqli_query($conn, $valid));
    if ($v->level == "Member") {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>window.location="anggota.php"</script>';
    }
    $validasi = mysqli_fetch_object($data);
    if ($validasi->created_by != $_COOKIE['id']) {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>window.location="anggota.php"</script>';
    }
    $default = 0;
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $alasan = $_POST['alasan'];
    $status = "Blokir";
    $currdate = date('Y-m-d H:i:s');
    //nanti tambahi inner join dalam delete
    $update = mysqli_query($conn, "UPDATE tb_pengguna SET 
    kd_projek = '" . $default . "'
    WHERE id = '" . $id . "'");

    if ($update) {
      $$insert = mysqli_query($conn, "INSERT INTO tb_blokir VALUES(
        null,
        '" . $id . "',
        '" . $kode . "',
        '" . $alasan . "',
        '" . $_COOKIE['id'] . "',
        '" . $currdate . "'
      )");
      $_SESSION['info'] = 'User Berhasil diBlokir';
      echo "<script>window.location='anggota.php'</script>";
    } else {
      $_SESSION['info'] = 'User Gagal diBlokir';
      echo "<script>window.location='anggota.php'</script>";
    }
  }
  echo "<script>window.location='anggota.php'</script>";
}
