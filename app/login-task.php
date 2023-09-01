<?php
session_start();
include '../connection/koneksi.php';
date_default_timezone_set("Asia/jakarta");
//cek cookei jika sudah login
if (isset($_COOKIE['remember_projek'])) {
  if ($_COOKIE['remember_projek'] == 'login') {
    $_SESSION['login_task'] = true;
  }
}
//cek jika sudah login projek
if (isset($_SESSION["login_task"])) {
  echo '<script>window.location="data-task.php"</script>';
}
//cek jika tidak login aplikasi
if (!isset($_SESSION["status_login"])) {
  echo '<script>window.location="../login.php"</script>';
}
//cek status diblokir aplikasi
$query = "SELECT * FROM tb_pengguna WHERE id = '" .  $_COOKIE['id'] . "'";
$run = mysqli_query($conn, $query);
$d = mysqli_fetch_array($run);
if ($d['status'] == 0) {
  echo '<script>window.location="../blokir-pengguna.php"</script>';
}
if (isset($_POST['login'])) {
  $kode = $_POST['kode'];
  $token = $_POST['token'];
  $aktif = 1;
  $cek = mysqli_query($conn, "SELECT * FROM tb_projek WHERE kode_projek = '" . $kode . "' AND token_projek = '" . $token . "'");
  if (mysqli_num_rows($cek) > 0) {
    $p = mysqli_fetch_object($cek);
    $confirm_user = mysqli_query($conn, "SELECT * FROM tb_blokir WHERE id_pengguna = '" . $_COOKIE['id'] . "' AND kd_projek = '" . $p->kode_projek . "'");
    if (mysqli_num_rows($confirm_user) > 0) {
      $_SESSION['info'] = 'Akun anda telah diblokir dari projek!';
    } else if ($p->status != $aktif) {
      $_SESSION['info'] = 'Status Tidak Aktif';
    } else {
      $update = mysqli_query($conn, "UPDATE tb_pengguna SET 
      kd_projek = '" . $kode . "'
      WHERE id = '" . $_COOKIE['id'] . "'");
      $_SESSION['login_task'] = true;
      setcookie('remember_projek', 'login', time() + (90 * 24 * 60 * 60)); //waktu 90 hari
      setcookie('kode', $p->kode_projek, time() + (90 * 24 * 60 * 60));
      setcookie('nama_projek', $p->nama, time() + (90 * 24 * 60 * 60));
      // $kedaluwarsa = time() + (90 * 24 * 60 * 60); waktu kedaluwarsa 90 hari
      // setcookie($nama_cookie, $nilai_cookie, $kedaluwarsa);
      $_SESSION['info'] = 'Login Berhasil';
      echo '<script>window.location="info-task.php"</script>';
    }
  } else {
    $_SESSION['info'] = 'Login Projek Gagal';
    echo '<script>history.go(-1);</script>';
  }
}

include "sidebar-task.php";
?>
<style>
  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
  }

  .form-signin .checkbox {
    font-weight: 400;
  }

  .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>
<h1 class="h3 mb-0">
  Login Task
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:10px"></p>
  </div>
</h1>
<hr>
<div class="container mt-5">
  <form class="form-signin" method="POST">
    <img class="mb-3 rounded text-center" src="../image/background/download.jfif" alt="" width="108" height="140" style="margin-left:87px;">
    <div class="form-group mb-2">
      <label for="inputuser" class="sr-only">Kode Projek</label>
      <input type="text" id="inputuser" name="kode" class="form-control" placeholder="Masukkan Kode Projek" required autofocus>
    </div>
    <div class="form-group mb-2">
      <label for="inputPassword" class="sr-only">Token Projek</label>
      <input type="text" id="inputPassword" name="token" class="form-control" placeholder="Masukkan Token Projek" required>
    </div>
    <button class="btn btn-warning btn-block" name="login" style="font-weight:700;" type="submit">Sign in</button>
    <p class="mt-3 ml-4 mb-3 text-dark">&copy; 2023 Developed by - <a target="_blank" rel="noopener noreferrer" href="https://fahmi965.000webhostapp.com/Portofolio.html" class="text-dark">
        FahmiCode</a></p>
  </form>
</div>
<!-- end isinya -->
<?php include 'footer.php'; ?>