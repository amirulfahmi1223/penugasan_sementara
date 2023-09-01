<?php
include 'sidebar.php';
if ($d['level'] == "Member") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
$projek = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.created_by = '" .  $_COOKIE['id'] . "'";
$run_projek = mysqli_query($conn, $projek);

//generate kode 
$alpha_numeric = "ABCDElmnopqrstFGHIJKLMNOPhijkuQRSVWXYZabcdefgvwxyzTU@";
$arr = array();
$lenght = strlen($alpha_numeric) - 2;
for ($i = 0; $i < 2; $i++) {
  $x = rand(0, $lenght);
  $arr[] = $alpha_numeric[$x];
}
$numeric = "01234567890@";
$array_numeric = array();
$panjang_array = strlen($numeric) - 2;
for ($i = 0; $i < 2; $i++) {
  $x = rand(0, $panjang_array);
  $array_numeric[] = $numeric[$x];
}
$i = rand(10, 100);
$random_code = implode($array_numeric) . $i . implode($arr);

//generate token
$alpha = "ABCDEFG123456HIJKLQRSTUVWXYZ0789MNOP@";
$array = array();
$panjang = strlen($alpha) - 2;
for ($i = 0; $i < 6; $i++) {
  //diulang 5 kali
  $x = rand(0, $panjang);
  $array[] = $alpha[$x];
}
$random_token = implode($array);

//tambah pengguna
if (isset($_POST['tambah'])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $kode = htmlspecialchars($_POST["kode"]);
  $token = htmlspecialchars($_POST["token"]);
  $deskripsi = htmlspecialchars($_POST["deskripsi"]);
  $target = $_POST["tanggal"];
  $status = $_POST["status"];
  $created_by = $_COOKIE['id'];
  $currdate = date('Y-m-d');
  $progress = 0;
  $result = mysqli_query($conn, "SELECT kode_projek FROM tb_projek WHERE kode_projek = '$kode'");
  if (mysqli_fetch_assoc($result)) {
    $_SESSION['info'] = 'Kode Projek Sudah Terdaftar!';
    echo '<script>window.location="projek.php"</script>';
  } else {
    $insert = mysqli_query($conn, "INSERT INTO tb_projek VALUES(
        '" . $kode . "',
        '" . $nama . "',
        '" . $deskripsi . "',
        '" . $token . "',
        '" . $progress . "',
        '" . $target . "',
        '" . $status . "',
        '" . $created_by . "',
        '" . $currdate . "',
        null
      )");
    if ($insert) {
      $_SESSION['info'] = 'Tambah Projek Berhasil';
      echo '<script>history.go(-1);</script>';
    } else {
      $_SESSION['info'] = 'Tambah Projek Gagal';
      echo '<script>history.go(-1);</script>';
    }
  }
}
?>

<!-- isinya -->
<h1 class="h3 mb-0">
  Daftar Projek
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus"></i> Tambah Projek</button>
</h1>
<hr>
<div class="row">
  <?php $no = 1;
  if (mysqli_num_rows($run_projek) > 0) {
    while ($p = mysqli_fetch_object($run_projek)) {
  ?>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-info o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              Nama Projek
            </div>
            <div class="mr-5 text-uppercase" style="font-size:20px;"><?= $p->projek; ?></div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="detail-projek.php?kode=<?= $p->kode_projek; ?>">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

    <?php }
  } else {
    ?>
    <div class="container text-center">

      <img class="img-fluid" src="../image/background/tidak-tersedia.png" width="362px" height="362px" alt="Responsive image">
      <h3>Belum ada projek yang dibuat</h3>
    </div>
</div>
<?php } ?>

<!-- Modal Tambah pengguna -->
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form method="POST">
        <div class="modal-header bg-purple">
          <h5 class="modal-title text-white">Tambah Projek</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="samll">Kode Projek :</label>
            <input type="text" name="kode" value="<?= $random_code; ?>" placeholder="Masukkan Nama" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label class="samll">Token Projek :</label>
            <input type="text" name="token" value="<?= $random_token; ?>" placeholder="Masukkan Username" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label class="samll">Nama Projek :</label>
            <input type="text" placeholder="Masukkan Nama projek" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Deskripsi :</label>
            <textarea placeholder="Masukkan Deskripsi" name="deskripsi" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label class="samll">Target Selesai :</label>
            <input type="date" name="tanggal" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Status :</label>
            <select name="status" id="" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onClick="document.location.reload(true)">Batal</button>
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Pengguna -->
<!-- end isinya -->
<?php include "footer.php" ?>