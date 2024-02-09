<?php
session_start();
//untuk menghapus satu session tertentu
unset($_SESSION['login_mygalery']);
setcookie("remember_mygalery", "", time() - 3600);
setcookie('id', '', time() - 3600);
//menyimpan perubahan sesi
session_write_close();
echo '<script>window.location="login.php"</script>';
