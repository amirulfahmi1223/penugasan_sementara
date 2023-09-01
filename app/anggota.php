<?php
include 'sidebar.php';
if ($d['level'] == "Member") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
if ($_GET['kode'] == "") {
  echo "<script>window.location = 'projek.php'</script>";
}
$query_projek = "SELECT * FROM tb_projek WHERE kode_projek = '" . $_GET['kode'] . "'";
$run_projek = mysqli_query($conn, $query_projek);
if (mysqli_num_rows($run_projek) < 1) {
  echo "<script>window.location='projek.php'</script>";
}
$projek = mysqli_fetch_object($run_projek);
if ($projek->created_by != $_COOKIE['id']) {
  if ($d['level'] != "Administrator") {
    $_SESSION['info'] = 'Maaf Akses di Tolak';
    echo '<script>history.go(-1);</script>';
  }
}
$query = "SELECT * FROM tb_pengguna WHERE kd_projek = '" . $_GET['kode'] . "'";
$run = mysqli_query($conn, $query);

//blokir anggota
if (isset($_POST['blokir'])) {
  $default = 0;
  $id = $_POST['id'];
  $kode = $_POST['kode'];
  $alasan = $_POST['alasan'];
  $status = "Blokir";
  $currdate = date('Y-m-d');
  $blokir_by = $d['nama'];
  $update = mysqli_query($conn, "UPDATE tb_pengguna SET 
    kd_projek = '" . $default . "'
    WHERE id = '" . $id . "'");

  if ($update) {
    //insert data ke table blokir
    $insert = mysqli_query($conn, "INSERT INTO tb_blokir VALUES(
        null,
        '" . $id . "',
        '" . $kode . "',
        '" . $alasan . "',
        '" . $blokir_by . "',
        '" . $currdate . "'
      )");
    $_SESSION['info'] = 'User Berhasil diBlokir';
    echo '<script>history.go(-1);</script>';
  } else {
    $_SESSION['info'] = 'User Gagal diBlokir';
    echo '<script>history.go(-1);</script>';
  }
}
?>
<!-- isinya -->
<h1 class="h3 mb-0 text-uppercase">
  Anggota <?= $projek->nama; ?>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Anggota</th>
      <th>Username</th>
      <th>Level</th>
      <th>Foto</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    while ($p = mysqli_fetch_array($run)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $p['nama']; ?></td>
        <td><?= $p['username']; ?></td>
        <td><?= $p['level']; ?></td>
        <td><a href="../uploads/profil/<?= $p['logo']; ?>" target="_blank"><img src="../uploads/profil/<?= $p['logo']; ?>" height="50px" width="50px" alt=""></a></td>
        <td>
          <a href="detail-anggota.php?kode=<?= $p['kd_projek'] ?>&id=<?= $p['id'] ?>" class="btn btn-warning btn-xs mr-1" ">
            <i class=" fa fa-eye mr-1"></i></i>Detail
          </a>
          <button type="button" class="btn btn-danger btn-xs mr-1" data-toggle="modal" data-target="#Blokir<?= $p['id'] ?>">
            <i class="fa fa-user mr-1"></i></i>Blokir
          </button>
        </td>
      </tr>
      <!-- Modal blokir -->
      <div class="modal fade" id="Blokir<?= $p['id'] ?>" tabindex=" -1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form method="POST">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Blokir Anggota</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="kode" value="<?= $p['kd_projek']; ?>">
                  <input type="hidden" name="id" value="<?= $p['id']; ?>">
                  <label class="samll">Nama Anggota :</label>
                  <input type="text" name="nama" value="<?= $p['nama']; ?>" placeholder="Masukkan Nama" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label class="samll">Diblokir dari projek :</label>
                  <input type="text" name="projek" value="<?= $projek->nama; ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label class="samll">Alasan Blokir :</label>
                  <textarea name="alasan" placeholder="Masukkan alasan blokir" class="form-control" cols="8" rows="4" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="blokir" class="btn btn-danger">Blokir</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </tbody>
</table>




<!-- end isinya -->
<?php include "footer.php" ?>