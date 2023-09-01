<?php
include 'sidebar.php';
$pengguna = mysqli_query($conn, "SELECT * FROM tb_pengguna");
$jumlah1 = mysqli_num_rows($pengguna);
if ($d['level'] == "Administrator") {
  $query = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id ORDER BY tb_projek.created_at ASC";
} else {
  $query = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.created_by = '" .  $_COOKIE['id'] . "'";
}
$projek = mysqli_query($conn, $query);
$jumlah2 = mysqli_num_rows($projek);
$blokir = mysqli_query($conn, "SELECT * FROM tb_blokir");
$jumlah3 = mysqli_num_rows($blokir);
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Beranda
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<div class="row">
  <?php if ($d['level'] == "Leader" or $d['level'] == "Administrator") { ?>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            Daftar Projek
          </div>
          <div class="mr-5" style="font-size:32px;"><?= $jumlah2 ?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="projek.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
  <?php }
  if ($d['level'] == "Administrator") { ?>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            Daftar Pengguna
          </div>
          <div class="mr-5" style="font-size:32px;"><?= $jumlah1 ?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="pengguna.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-secondary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            Daftar Blokir
          </div>
          <div class="mr-5" style="font-size:32px;"><?= $jumlah3 ?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="daftar-blokir.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
  <?php } ?>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Terselesaikan
        </div>
        <div class="mr-5" style="font-size:32px;"><?= "2373" ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="siswa.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Belum Terselesaikan
        </div>
        <div class="mr-5" style="font-size:32px;"><?= "2373" ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="siswa.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>


<!-- end isinya -->
<?php include 'footer.php'; ?>