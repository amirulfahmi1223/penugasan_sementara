<?php
session_start();
include '../connection/koneksi.php';
date_default_timezone_set("Asia/jakarta");
if (!isset($_SESSION["status_login"])) {
  echo '<script>window.location="../login.php"</script>';
}
$query = "SELECT * FROM tb_pengguna WHERE id = '" .  $_COOKIE['id'] . "'";
$run = mysqli_query($conn, $query);
$d = mysqli_fetch_array($run);
if ($d['status'] == 0) {
  echo '<script>window.location="../blokir-pengguna.php"</script>';
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi - Assignment</title>
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
          <a href="./"><i class="fa fa-credit-card mr-1 text-uppercase"></i>assignment.id</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic" style="height:70px;width:70px;">
            <img class="img-responsive img-rounded" src="../uploads/profil/<?= $d['logo']; ?>" alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name"><?= $d['nama']; ?>
            </span>
            <span class="user-role"><?= $d['level'] ?> <?= $d['level'] != 'Administrator' ? 'Team' : '' ?></span>
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
              <a href="info-task.php">
                <i class="fa fa-fw fa-bookmark"></i>
                <span>Assignment</span>
              </a>
            </li>

            <?php
            if ($d['level'] == "Administrator" || $d['level'] == "Leader") { ?>
              <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fa fa-briefcase"></i>
                  <span>Projek</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white ml-3 rounded" style="width:88%;">
                    <a class="collapse-item text-muted" href="daftar-projek.php"><i class="fas fa-fw fa-folder text-body"></i><span>Daftar Projek</span></a>
                    <a class="collapse-item text-muted" href="projek.php"><i class="fa fa-wrench text-body"></i><span>Pengaturan projek</span></a>
                  </div>
                </div>
              </li>
            <?php } ?>
            <?php
            if ($d['level'] == "Administrator") { ?>
              <li>
                <a href="pengguna.php">
                  <i class="fas fa-users"></i>
                  <span>Pengguna</span>
                </a>
              </li>
              <li>
                <a href="daftar-blokir.php">
                  <i class="fas fa-key"></i>
                  <span>Blokir</span>
                </a>
              </li>
            <?php  }  ?>
            <li>
              <a href="pengaturan.php">
                <i class="fa fa-cog"></i>
                <span>Pengaturan</span>
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
        <!-- sidebar-menu  -->
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