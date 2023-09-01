<?php
session_start();
// menghapus satu sesi
$_SESSION['info'] = "Akun anda telah diblokir!";
unset($_SESSION['status_login']);
setcookie("remember", "", time() - 3600);
setcookie('id', '', time() - 3600);
//menyimpan perubahan sesi
session_write_close();
echo '<script>window.location="login.php"</script>';
