<?php
session_start();
// menghapus satu sesi
unset($_SESSION['login_task']);
unset($_SESSION['status_login']);
setcookie("remember", "", time() - 3600);
setcookie('id', '', time() - 3600);
setcookie("remember_projek", '', time() - 3600);
setcookie('kode', '', time() - 3600);
//menyimpan perubahan sesi
session_write_close();
echo '<script>window.location="login.php"</script>';
