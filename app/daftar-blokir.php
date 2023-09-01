<?php
include 'sidebar.php';
if ($d['level'] == "Member" || $d['level'] == "Leader") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}

$query = "SELECT tb_pengguna.nama AS pengguna,tb_pengguna.username,tb_blokir.alasan,tb_projek.nama AS projek,tb_blokir.created_at,tb_blokir.id,tb_blokir.blokir_by,tb_pengguna.logo,tb_pengguna.status,tb_blokir.kd_projek FROM tb_blokir INNER JOIN tb_pengguna ON tb_blokir.id_pengguna = tb_pengguna.id INNER JOIN tb_projek ON tb_blokir.kd_projek = tb_projek.kode_projek";
$run = mysqli_query($conn, $query);

//blokir pengguna
if (isset($_POST['blokir'])) {
  $id = $_POST['pengguna'];
  $kode = $_POST['projek'];
  $alasan = $_POST['alasan'];
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
<h1 class="h3 mb-0">
  Daftar Blokir
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus"></i> Tambah Blokir</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Pengguna</th>
      <th>Username</th>
      <th>Diblokir Dari</th>
      <th>Diblokir Oleh</th>
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
        <td><?= $p['pengguna']; ?></td>
        <td><?= $p['username']; ?></td>
        <td><?= $p['projek']; ?></td>
        <td><?= $p['blokir_by']; ?></td>
        <td><a href="../uploads/profil/<?= $p['logo']; ?>" target="_blank"><img src="../uploads/profil/<?= $p['logo']; ?>" height="50px" width="50px" alt=""></a></td>
        <td>
          <a href="detail-blokir.php?id=<?= $p['id']; ?>" class="btn btn-warning btn-xs mr-1">
            <i class="fa fa-eye mr-1"></i>Detail
          </a>
          <a class="btn btn-success btn-xs aktifkan-data" href="proses-aktifkan.php?id=<?= $p['id']; ?>">
            <i class="fa fa-key fa-xs mr-1"></i>Aktifkan</a>
        </td>
      </tr>
      <!-- end Modal edit -->
    <?php } ?>

  </tbody>
</table>

<!-- Modal Tambah pengguna -->
<!-- Modal blokir -->
<div class="modal fade" id="Tambah" tabindex=" -1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form method="POST">
        <div class="modal-header bg-purple">
          <h5 class="modal-title text-white">Blokir Pengguna</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
        $pengguna = mysqli_query($conn, "SELECT * FROM tb_pengguna");
        $projek = mysqli_query($conn, "SELECT * FROM tb_projek");
        $user = mysqli_fetch_object($pengguna);
        ?>
        <div class="modal-body">
          <div class="form-group">
            <label class="samll">Nama Anggota :</label>
            <select name="pengguna" id="" class="form-control" required>
              <option value="">-- Pilih Pengguna --</option>
              <?php
              if ($user->kd_projek != 0) { ?>
                <?php while ($user) { ?>
                  <option value="<?= $user->id ?>"><?= $user->nama; ?></option>
                <?php } ?>
              <?php } else { ?>
                <option value="<?= $user->id ?>">Belum ada anggota projek</option>
              <?php } ?>

            </select>
          </div>
          <div class="form-group">
            <label class="samll">Diblokir dari projek :</label>
            <select name="projek" id="" class="form-control" required>
              <option value="">-- Pilih Projek --</option>
              <?php while ($pr = mysqli_fetch_object($projek)) { ?>
                <option value="<?= $pr->kode_projek ?>"><?= $pr->nama; ?></option>
              <?php } ?>
            </select>
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
</tbody>
</table>


<!-- end isinya -->
<?php include "footer.php" ?>