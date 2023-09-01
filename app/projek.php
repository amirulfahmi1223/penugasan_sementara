<?php
include 'sidebar.php';
if ($d['level'] == "Member") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
if ($d['level'] == "Administrator") {
  $projek = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_pengguna.level,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id ORDER BY tb_projek.created_at ASC";
} else {
  $projek = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_pengguna.level,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.created_by = '" .  $_COOKIE['id'] . "'";
}
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
  Pengaturan Projek
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus"></i> Tambah Projek</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Projek</th>
      <th>Nama Projek</th>
      <th>Token Projek</th>
      <th>Progress</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    while ($p = mysqli_fetch_object($run_projek)) {

    ?>

      <tr>
        <td><?= $no++; ?></td>
        <td><?= $p->kode_projek; ?></td>
        <td><?= $p->projek; ?></td>
        <td><?= $p->token_projek; ?></td>
        <td><?= $p->progress_projek; ?>%</td>

        <td><?= $p->status == "1" ? "Aktif" : "Tidak Aktif"; ?></td>
        <td>
          <a href="detail-projek.php?kode=<?= $p->kode_projek; ?>" class="btn btn-warning btn-xs mr-1">
            <i class="fa fa-eye mr-1"></i>Detail
          </a>
          <a href="anggota.php?kode=<?= $p->kode_projek; ?>" class="btn btn-success btn-xs mr-1">
            <i class="fas fa-users fa-xs mr-1"></i>Anggota
          </a>
          <a href="edit-projek.php?kode=<?= $p->kode_projek ?>" class="btn btn-primary btn-xs mr-1">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </a>
          <?php if ($d['level'] == "Administrator") { ?>
            <a class="btn btn-danger btn-xs delete-data" href="delete/hapus-projek.php?kode=<?= $p->kode_projek; ?>">
              <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
          <?php } ?>
        </td>
      </tr>

    <?php } ?>
  </tbody>
</table>


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
            <textarea placeholder="Masukkan Deskripsi" name="deskripsi" class="form-control" cols="8" rows="3" required></textarea>
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