<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_mygaleri';
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  echo 'Koneksi Gagal :' . mysqli_connect_error($conn);
}
