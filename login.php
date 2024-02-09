<?php
session_start();
include "connection/koneksi.php";
if (isset($_COOKIE['remember_mygalery'])) {
  if ($_COOKIE['remember_mygalery'] == 'true') {
    $_SESSION['login_mygalery'] = true;
  }
}
if (isset($_SESSION["login_mygalery"])) {
  echo '<script>window.location="admin/index.php"</script>';
}
if (isset($_POST["login"])) {
  $user = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  //cek akun ada apa tidak
  $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '" . $user . "' AND password = '" . $password . "'");
  if (mysqli_num_rows($cek) > 0) {
    $d = mysqli_fetch_object($cek);
    $_SESSION['login_mygalery'] = true;
    $id = $d->id_pengguna;
    setcookie('remember_mygalery', 'true', time() + 2592000); //waktu 30 hari
    setcookie('id', $id, time() + 2592000); //waktu 30 hari
    // $_SESSION['info'] = 'Login Berhasil';
    //cek remember me
    if (isset($_POST['remember'])) {
      //buat cookei
      setcookie('remember_mygalery', 'true', time() + 2592000); //waktu 30 hari
      setcookie('id', $id, time() + 2592000); //waktu 30 hari
    }
    //$_COOKEI sendiri untuk menyimpan data user untuk beberapa waktu
    //ada waktu kadarulasa

    $_SESSION['info'] = 'Login Berhasil';
    echo '<script>window.location="admin/index.php"</script>';
  } else {
    $_SESSION['info'] = 'Login Gagal';
  }
}




?>

<!DOCTYPE html>
<html>

<head>
  <title>Login Form</title>
  <link rel="icon" type="image/x-icon" href="img/logotitle.png" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <!-- SWAL -->
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                          echo $_SESSION['info'];
                                        }
                                        ?>"></div>
  <img class="wave" src="image/wave-biru.png">
  <div class="container">
    <div class="img">
      <img src="image/dallas-two-color.svg">
    </div>
    <div class="login-content">
      <form action="" method="POST">
        <img src="image/avatar.png">
        <h2 class="title">Welcome</h2>
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <h5>Email</h5>
            <input type="email" name="email" class="input">
          </div>
        </div>
        <div class="input-div pass">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <h5>Password</h5>
            <input type="password" name="password" class="input">
          </div>
        </div>
        <div class="remember" style="text-align:left;
        margin-left:26px;
        display:block;
        text-decoration: none;
        color: #999;
        font-size: 1rem;">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember" style="color:#999;">Remember Me</label>
        </div>
        <input type="submit" class="btn" name="login" value="Login">
      </form>
    </div>
  </div>
  <!-- sweet alert -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script>
    const notifikasi = $('.info-data').data('infodata');

    if (notifikasi == "Login Berhasil" || notifikasi == "Register Berhasil") {
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: notifikasi,
      })
    } else if (notifikasi == "Login Gagal") {
      Swal.fire({
        icon: 'error',
        title: 'GAGAL',
        text: 'Gagal, username atau password salah!',
      })
    } else if (notifikasi == "Akun Anda Telah diBlokir!") {
      Swal.fire({
        icon: 'error',
        title: 'GAGAL',
        text: notifikasi,
      })
    } else if (notifikasi == "Akun anda telah diblokir!") {
      Swal.fire({
        icon: 'warning',
        title: 'PERINGATAN',
        text: notifikasi,
      })
    }
  </script>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>