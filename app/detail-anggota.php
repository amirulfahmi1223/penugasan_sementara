<?php
include 'sidebar.php';
if ($d['level'] == "Member") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}
if ($_GET['kode'] == "" && $_GET['id'] == "") {
  echo "<script>window.location = 'anggota.php'</script>";
}
$query_projek = "SELECT * FROM tb_projek WHERE kode_projek = '" . $_GET['kode'] . "'";
$run_projek = mysqli_query($conn, $query_projek);
if (mysqli_num_rows($run_projek) > 0) {
  $projek = mysqli_fetch_object($run_projek);
  if ($projek->created_by != $_COOKIE['id']) {
    if ($d['level'] != "Administrator") {
      $_SESSION['info'] = 'Maaf Akses di Tolak';
      echo '<script>history.go(-1);</script>';
    }
  }
  $query = "SELECT * FROM tb_pengguna WHERE id = '" . $_GET['id'] . "'";
  $run = mysqli_query($conn, $query);
  $p = mysqli_fetch_object($run);
?>
  <!-- isinya -->
  <h1 class="h3 mb-0">
    Detail Anggota
  </h1>
  <hr>
  <!-- Modal Detail -->


  <div class="modal-body">

    <table border="0" width="100%" cellpadding="10px" style="padding-left: 2px; padding-right: 13px;">
      <tbody>
        <tr>
          <td width="25%" valign="top" class="text">Nama Anggota</td>
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
          <td class="text">Anggota Projek</td>
          <td>:</td>
          <td class="text-success"><?= $projek->nama; ?></td>
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
    window.location = 'anggota.php'
  </script>
<?php } ?>
<!-- end isinya -->
<?php include "footer.php" ?>