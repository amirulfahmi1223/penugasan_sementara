<?php
include 'sidebar.php';
if ($d['level'] == "Member") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
if ($_GET['kode'] == "") {
  echo "<script>window.location = 'projek.php'</script>";
}
$hitung = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE kd_projek = '" . $_GET['kode'] . "'");
$jumlah_member = mysqli_num_rows($hitung);
$projek = "SELECT tb_pengguna.nama AS pengguna,tb_pengguna.level,tb_projek.kode_projek,tb_projek.nama AS projek,tb_projek.created_by, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.kode_projek= '" .  $_GET['kode'] . "'";
$run_projek = mysqli_query($conn, $projek);
if (mysqli_num_rows($run_projek) > 0) {
  $p = mysqli_fetch_object($run_projek);
  if ($p->created_by != $_COOKIE['id']) {
    if ($p->level != "Administrator") {
      echo '<script>window.location="projek.php"</script>';
    }
  }


?>
  <!-- isinya -->
  <h1 class="h3 mb-0">
    Detail Projek
  </h1>
  <hr>
  <!-- Modal Detail -->


  <div class="modal-body">

    <table border="0" width="100%" cellpadding="7px" style="padding-left: 9px; padding-right: 13px;">
      <tbody>
        <tr>
          <td width="25%" valign="top" class="text">Kode Projek</td>
          <td width="2%">:</td>
          <td style="color: #2a8c40; font-weight:bold"><?= $p->kode_projek; ?></td>
        </tr>
        <tr>
          <td class="text">Nama Projek</td>
          <td>:</td>
          <td style="color: #2a8c40; font-weight:bold"><?= $p->projek; ?></td>
        </tr>
        <tr>
          <td class="textt">Token Projek</td>
          <td>:</td>
          <td style="color: #2a8c40; font-weight:bold"><?= $p->token_projek; ?></td>
        </tr>
        <tr>
          <td class="text">Deskripsi</td>
          <td>:</td>
          <td><?= $p->deskripsi; ?></td>
        </tr>
        <tr>
          <td valign="top" class="text">Progress Projek</td>
          <td>:</td>
          <td>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="<?= $p->progress_projek; ?>%" aria-valuemin="0" aria-valuemax="100" style="width:<?= $p->progress_projek; ?>%">
                <?php if ($p->progress_projek == 0) { ?>
                  <div class="font-weight-bold text-dark"><?= $p->progress_projek; ?>%</div>
                <?php } else { ?>
                  <div class="font-weight-bold text-white"><?= $p->progress_projek; ?>%</div>
                <?php } ?>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="text">Jumlah Anggota</td>
          <td>:</td>
          <td><?= $jumlah_member == 0 ? "Belum ada yang bergabung" : $jumlah_member; ?></td>
        </tr>
        <tr>
          <td class="text">Dibuat Oleh</td>
          <td>:</td>
          <td><?= $p->pengguna; ?></td>
        </tr>
        <tr>
          <td class="text">Tanggal diBuat</td>
          <td>:</td>
          <td><?= $p->created_at; ?></td>
        </tr>
        <tr>
          <td class="text">Target Selesai</td>
          <td>:</td>
          <td><?= $p->target_selesai; ?></td>
        </tr>
        <tr>
          <td class="text">Status</td>
          <td>:</td>
          <td><?= $p->status == "1" ? "Aktif" : "Tidak Aktif"; ?></td>
        </tr>
        <tr>
          <td class="text">Terakhir diUpdate</td>
          <td>:</td>
          <td><?= $p->update_at == null ? "Belum diUpdate" : $p->update_at; ?></td>
        </tr>
      </tbody>
    </table>
    </td>
    </tr>
    <hr>
    <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
    </tbody>
    </table>
  </div>



<?php } else { ?>
  <script>
    window.location = 'projek.php'
  </script>
<?php } ?>
<!-- end isinya -->
<?php include "footer.php" ?>