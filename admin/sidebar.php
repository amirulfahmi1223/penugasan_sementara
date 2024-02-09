<?php
session_start();
include '../connection/koneksi.php';
date_default_timezone_set("Asia/jakarta");
if (!isset($_SESSION["login_mygalery"])) {
  echo '<script>window.location="../login.php"</script>';
}
$query = "SELECT * FROM pengguna WHERE id_pengguna = '" .  $_COOKIE['id'] . "'";
$run = mysqli_query($conn, $query);
$d = mysqli_fetch_array($run);

if (isset($_POST['ubah'])) {
  $pass1 = htmlspecialchars($_POST['pass1']);
  $pass2 = htmlspecialchars($_POST['pass2']);
  $id = $_POST['id_pengguna'];
  //query insert data

  //cek konfirmasi password
  if ($pass2 != $pass1) {
    echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
  } else {
    $u_pass = mysqli_query($conn, "UPDATE pengguna SET 
     password = '" . $pass1 . "'
     WHERE id_pengguna = '" . $id . "'");
    if ($u_pass) {
      $_SESSION['info'] = 'Password Berhasil di Update';
      echo '<script>history.go(-1);</script>';
    } else {
      $_SESSION['info'] = 'Gagal update password';
      echo '<script>history.go(-1);</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Admin - Photo</title>
  <link rel="icon" href="../image/background/favicon.ico">
  <link rel="icon" href="../image/background/favicon.ico" type="image/ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                          echo $_SESSION['info'];
                                        }
                                        unset($_SESSION['info']); ?>"></div>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-primary border-0" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="./"><i class="fa fa-credit-card mr-1 text-uppercase"></i> <i class="fa-solid fa-school"></i>MY GALERY</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic" style="height:70px;width:70px;">
            <img class="img-responsive img-rounded" src="../uploads/profil/new-default.png" alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name"><?= $d['nama']; ?>
            </span>
            <span class="user-role"><?= "Admin" ?></span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li>
              <a href="index.php">
                <i class="fas fa-tv"></i>
                <span>Beranda</span>
              </a>
            </li>
            <li>
              <a href="kategori.php">
                <i class="fa fa-fw fa-bookmark"></i>
                <span>Kategori</span>
              </a>
            </li>
            <li>
              <a href="foto.php">
                <i class="fa fa-camera-retro"></i>
                <span>Photo</span>
              </a>
            </li>

            <li>
              <a href="#" data-toggle="modal" data-target="#Setting">
                <i class="fa fa-user"></i>
                <span>Pengaturan Akun</span>
              </a>
            </li>
            <li>
              <a href="#Exit" data-toggle="modal">
                <i class="fa fa-power-off"></i>
                <span>Keluar</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="sidebar-footer">
        © 2023 Developed by - <a target="_blank" rel="noopener noreferrer" href="https://fahmi965.000webhostapp.com/Portofolio.html">
          FahmiCode</a>
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
      <div class="container-fluid">
        <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>