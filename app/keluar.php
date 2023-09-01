<?php
session_start();
//untuk menghapus satu session tertentu
unset($_SESSION['login_task']);
setcookie("remember_projek", "", time() - 3600);
setcookie('kode', '', time() - 3600);
//menyimpan perubahan sesi
session_write_close();
echo '<script>window.location="login-task.php"</script>';
