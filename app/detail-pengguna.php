<?php
include 'sidebar.php';
if ($d['level'] == "Member" && $d['level'] == "Leader") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
if ($_GET['id'] == '') {
  echo '<script>window.location="pengguna.php"</script>';
}
$query = "SELECT * FROM tb_pengguna WHERE id = '" . $_GET['id'] . "'";
$run = mysqli_query($conn, $query);
if (mysqli_num_rows($run) > 0) {
  $p = mysqli_fetch_object($run);
  //menampilkan data projek
  $kode = $p->kd_projek;
  $val = mysqli_query($conn, "SELECT nama AS projek FROM tb_projek WHERE kode_projek = '" . $kode . "'");
  $data = mysqli_fetch_object($val);
?>
  <!-- isinya -->
  <h1 class="h3 mb-0">
    Detail Pengguna
  </h1>
  <hr>
  <!-- Modal Detail -->


  <div class="modal-body">

    <table border="0" width="100%" cellpadding="10px" style="padding-left: 2px; padding-right: 13px;">
      <tbody>
        <tr>
          <td width="25%" valign="top" class="text">Nama Pengguna</td>
          <td width="2%">:</td>
          <td><?= $p->nama; ?></td>
        </tr>
        <tr>
          <td class="text">Username</td>
          <td>:</td>
          <td><?= $p->username; ?></td>
        </tr>
        <tr>
          <td class="textt">Email Pengguna</td>
          <td>:</td>
          <td><?= $p->email; ?></td>
        </tr>
        <tr>
          <td class="text">No.Telepon</td>
          <td>:</td>
          <td><?= $p->tlpn; ?></td>
        </tr>
        <tr>
          <td class="text">Password</td>
          <td>:</td>
          <td><?= $p->password; ?></td>
        </tr>
        <tr>
          <td class="text">Mengikuti Projek</td>
          <td>:</td>
          <?php if ($p->kd_projek != 0) { ?>
            <td class="text-success"><?= $data->projek; ?></td>
          <?php } else { ?>
            <td class="text-danger">Belum Bergabung</td>
          <?php } ?>
        </tr>
        <tr>
          <td class="text">Level</td>
          <td>:</td>
          <td><?= $p->level; ?></td>
        </tr>
        <tr>
          <td class="text">Status</td>
          <td>:</td>
          <td><?= $p->status = 1 ? "Aktif" : "Tidak Aktif"; ?></td>
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
    window.location = 'pengguna.php'
  </script>
<?php } ?>
<!-- end isinya -->
<?php include "footer.php" ?>