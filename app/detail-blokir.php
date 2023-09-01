<?php
include 'sidebar.php';
if ($d['level'] == "Member" || $d['level'] == "Leader") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}

if ($_GET['id'] == "") {
  echo "<script>window.location = 'daftar-blokir.php'</script>";
}
$query = "SELECT tb_pengguna.nama AS pengguna,tb_pengguna.username,tb_blokir.alasan,tb_projek.nama AS nm_projek,tb_pengguna.level,tb_pengguna.status,tb_blokir.created_at,tb_blokir.id,tb_blokir.blokir_by,tb_pengguna.logo,tb_pengguna.status,tb_blokir.kd_projek FROM tb_blokir INNER JOIN tb_pengguna ON tb_blokir.id_pengguna = tb_pengguna.id INNER JOIN tb_projek ON tb_blokir.kd_projek = tb_projek.kode_projek WHERE tb_blokir.id = '" . $_GET['id'] . "'";
$run = mysqli_query($conn, $query);

if (mysqli_num_rows($run) > 0) {
  $blokir = mysqli_fetch_object($run);
?>
  <!-- isinya -->
  <h1 class="h3 mb-0">
    Detail Blokir
  </h1>
  <hr>
  <!-- Modal Detail -->


  <div class="modal-body">

    <table border="0" width="100%" cellpadding="10px" style="padding-left: 2px; padding-right: 13px;">
      <tbody>
        <tr>
          <td width="25%" valign="top" class="text">Nama Pengguna</td>
          <td width="2%">:</td>
          <td><?= $blokir->pengguna; ?></td>
        </tr>
        <tr>
          <td class="text">Username</td>
          <td>:</td>
          <td><?= $blokir->username; ?></td>
        </tr>
        <tr>
          <td class="text">Level</td>
          <td>:</td>
          <td><?= $blokir->level; ?></td>
        </tr>
        <tr>
          <td class="text">Status</td>
          <td>:</td>
          <td><?= $blokir->status = 1 ? "Aktif" : "Tidak Aktif"; ?></td>
        </tr>
        <tr>
          <td class="text">Diblokir Dari</td>
          <td>:</td>
          <td class="">Projek <?= $blokir->nm_projek; ?></td>
        </tr>
        <tr>
          <td class="text">Diblokir Oleh</td>
          <td>:</td>
          <td><?= $blokir->blokir_by; ?></td>
        </tr>
        <tr>
          <td class="text">Tanggal Blokir</td>
          <td>:</td>
          <td><?= $blokir->created_at; ?></td>
        </tr>
        <tr>
          <td class="text">Alasan Blokir</td>
          <td>:</td>
          <td><?= $blokir->alasan; ?></td>
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
    window.location = 'anggota.php'
  </script>
<?php } ?>
<!-- end isinya -->
<?php include "footer.php" ?>