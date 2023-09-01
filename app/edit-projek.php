<?php
include 'sidebar.php';
if ($d['level'] == "Member") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
if ($_GET['kode'] == "") {
  echo "<script>window.location = 'projek.php'</script>";
}
$projek = "SELECT tb_pengguna.nama AS pengguna,tb_pengguna.level,tb_projek.kode_projek,tb_projek.nama AS projek,tb_projek.created_by, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.kode_projek= '" .  $_GET['kode'] . "'";
$run_projek = mysqli_query($conn, $projek);
if (mysqli_num_rows($run_projek) > 0) {
  $p = mysqli_fetch_object($run_projek);
  if ($p->created_by != $_COOKIE['id']) {
    if ($d['level'] != "Administrator") {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>history.go(-1);</script>';
    }
  }
  //edit
  if (isset($_POST['edit'])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $kode = htmlspecialchars($_POST["kode"]);
    $token = htmlspecialchars($_POST["token"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $target = $_POST["tanggal"];
    $status = $_POST["status"];
    $progress = $_POST['progress'];
    $currdate = date('Y-m-d H:i:s');
    $update = mysqli_query($conn, "UPDATE tb_projek SET
        nama = '" . $nama . "',
        deskripsi = '" . $deskripsi . "',
        progress_projek = '" . $progress . "',
        target_selesai = '" . $target . "',
        status = '" . $status . "',
        update_at = '" . $currdate . "'
        WHERE kode_projek = '" . $_GET['kode'] . "'
  ");
    if ($update) {
      $_SESSION['info'] = 'Edit Projek Berhasil';
      echo '<script>history.go(-1);</script>';
    } else {
      $_SESSION['info'] = 'Edit Projek Gagal';
      echo '<script>history.go(-1);</script>';
    }
  }
  if (isset($_POST['ubahtoken'])) {
    $currdate = date('Y-m-d H:i:s');
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
    $update = mysqli_query($conn, "UPDATE tb_projek SET
    token_projek = '" . $random_token . "',
    update_at = '" . $currdate . "'
    WHERE kode_projek = '" . $_GET['kode'] . "'");
    if ($update) {
      $_SESSION['info'] = 'Edit Projek Berhasil';
      echo '<script>history.go(-1);</script>';
    } else {
      $_SESSION['info'] = 'Edit Projek Gagal';
      echo '<script>history.go(-1);</script>';
    }
  }
?>
  <!-- isinya -->
  <h1 class="h3 mb-0">
    Edit Projek
    <div class="float-right ml-1 mt-2" style="font-size:13px;"> <?= $p->update_at == null ? "Belum diUpdate" : $p->update_at; ?> </div>
    <div class="float-right mt-2" style="font-size:13px;">Last Update :</div>
    <!-- <div class="float-right btn btn-warning btn-sm border-0 float-right ml-1" style="font-size:14px;">Last Update : <?= $p->update_at; ?></div> -->
  </h1>
  <hr>
  <div class="modal-content border-0">
    <form method="POST">
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-6">
            <label class="samll">Kode Projek :</label>
            <input type="text" name="kode" value="<?= $p->kode_projek; ?>" placeholder="Masukkan Nama" class="form-control" readonly>
          </div>
          <div class="form-group col-6">
            <label class="samll">Token Projek :</label>
            <input type="text" name="token" value="<?= $p->token_projek; ?>" placeholder="Masukkan Username" class="form-control" readonly>
          </div>
        </div>
        <div class="text-left">
          <button type="submit" name="ubahtoken" class="btn btn-primary">Ubah Token</button>
        </div>
        <hr>
        <div class="row">
          <div class="form-group col-6">
            <label class="samll">Nama Projek :</label>
            <input type="text" placeholder="Masukkan Nama projek" value="<?= $p->projek; ?>" name="nama" class="form-control" required>
          </div>
          <div class="form-group col-6">
            <label class="samll">Progress Projek :</label>
            <input type="number" placeholder="Masukkan Progress" value="<?= $p->progress_projek; ?>" name="progress" class="form-control" required>
          </div>
        </div>
        <div class="form-group">
          <label class="samll">Deskripsi :</label>
          <textarea placeholder="Masukkan Deskripsi" name="deskripsi" class="form-control" cols="8" rows="3" required><?= $p->deskripsi; ?></textarea>
        </div>
        <div class="row">
          <div class="form-group col-6">
            <label class="samll">Target Selesai :</label>
            <input type="date" name="tanggal" value="<?= $p->target_selesai; ?>" class="form-control" required>
          </div>
          <div class="form-group col-6">
            <label class="samll">Status :</label>
            <select name="status" id="" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="1" <?= $p->target_status = 1 ? "selected" : ""; ?>>Aktif</option>
              <option value="0" <?= $p->target_status = 0 ? "selected" : ""; ?>>Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="text-left mt-2">
          <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
          <button type="submit" name="edit" class="btn btn-primary">Ubah Data</button>
        </div>
      </div>
    </form>
  </div>
<?php } else { ?>
  <script>
    window.location = 'projek.php'
  </script>
<?php } ?>
<!-- end isinya -->
<?php include "footer.php" ?>