<?php include  "sidebar.php";
$a = mysqli_query($conn, "SELECT * FROM foto");
$jumlah1 = mysqli_num_rows($a);
$b = mysqli_query($conn, "SELECT * FROM kategori");
$jumlah2 = mysqli_num_rows($b);
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
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Data Foto
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah1; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="foto.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-info o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Data Kategori
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah2; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="kategori.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-7">
      <div class="panel">
        <header class="panel-heading">
          Daftar Anggota Baru
        </header>

        <ul class="list-group teammates">
          <li class="list-group-item">
            <a href="anggota.php"><img src="gambar_anggota/face-2.jpg" width="50" height="50" style="border: 3px solid #555555;"></a>
            <a href="anggota.php">Nadia Shivana</a>
          </li>
        </ul>
        <ul class="list-group teammates">
          <li class="list-group-item">
            <a href="anggota.php"><img src="gambar_anggota/5.jpg" width="50" height="50" style="border: 3px solid #555555;"></a>
            <a href="anggota.php">DEDE RIZKI RAMADHAN</a>
          </li>
        </ul>
        <ul class="list-group teammates">
          <li class="list-group-item">
            <a href="anggota.php"><img src="gambar_anggota/2.jpg" width="50" height="50" style="border: 3px solid #555555;"></a>
            <a href="anggota.php">ANTON SUGIANTO</a>
          </li>
        </ul>
        <div class="panel-footer bg-white">
          <!-- <span class="pull-right badge badge-info">32</span> -->
          <a href="anggota.php" class="btn btn-sm btn-info">Data Anggota <i class="fa fa-plus"></i></a>
        </div>
      </div>
    </div>

    <div class="col-lg-5">

      <!--chat start-->
      <section class="panel">
        <header class="panel-heading">
          Pemberitahuan
        </header>
        <div class="panel-body" id="noti-box">
          <div class="alert alert-block alert-danger">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong>Nadia Shivana</strong>, Telah terdaftar menjadi anggota perpustakaan.
          </div>

          <div class="alert alert-success">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong>Amirul Fahmi</strong>, Telah ditambahkan menjadi admin PerPusWeb yang baru.
          </div>

          <div class="alert alert-info">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong>Membangun Aplikasi Nilai Dengan PHP</strong>, Buku bacaan baru yang ada di PerPusWeb.
          </div>

          <div class="alert alert-warning">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong>fahmi </strong> Pengunjung baru di PerPusWeb.
          </div>
        </div>
      </section>



    </div>


  </div>

  <div class="row">


    <div class="col-md-7">
      <section class="panel tasks-widget">
        <header class="panel-heading">
          Daftar Bacaan PerPusWeb
        </header>
        <div class="panel-body">

          <div class="task-content">

            <ul class="task-list">
              <li>
                <div class="task-checkbox">
                  <!-- <input type="checkbox" class="list-child" value=""  /> -->
                  <input type="checkbox" class="flat-grey list-child" />
                  <!-- <input type="checkbox" class="square-grey"/> -->
                </div>
                <div class="task-title">
                  <span class="task-title-sp">Membangun Aplikasi Nilai Dengan PHP</span>
                  <span class="label label-primary">2015-10-10 07:48:50</span>
                  <div class="pull-right hidden-phone">
                    <button class="btn btn-info btn-xs"><i class="fa fa-check"></i></button>
                    <button class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                  </div>
                </div>
              </li>
              <li>
                <div class="task-checkbox">
                  <!-- <input type="checkbox" class="list-child" value=""  /> -->
                  <input type="checkbox" class="flat-grey list-child" />
                  <!-- <input type="checkbox" class="square-grey"/> -->
                </div>
                <div class="task-title">
                  <span class="task-title-sp">Membangun Aplikasi Perpustakaan Berbasis Web</span>
                  <span class="label label-primary">2015-10-10 07:44:54</span>
                  <div class="pull-right hidden-phone">
                    <button class="btn btn-info btn-xs"><i class="fa fa-check"></i></button>
                    <button class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                  </div>
                </div>
              </li>
              <li>
                <div class="task-checkbox">
                  <!-- <input type="checkbox" class="list-child" value=""  /> -->
                  <input type="checkbox" class="flat-grey list-child" />
                  <!-- <input type="checkbox" class="square-grey"/> -->
                </div>
                <div class="task-title">
                  <span class="task-title-sp">Aplikasi Penggajian Karyawan dengan PHP</span>
                  <span class="label label-primary">2015-10-10 07:46:00</span>
                  <div class="pull-right hidden-phone">
                    <button class="btn btn-info btn-xs"><i class="fa fa-check"></i></button>
                    <button class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                  </div>
                </div>
              </li>
              <li>
                <div class="task-checkbox">
                  <!-- <input type="checkbox" class="list-child" value=""  /> -->
                  <input type="checkbox" class="flat-grey list-child" />
                  <!-- <input type="checkbox" class="square-grey"/> -->
                </div>
                <div class="task-title">
                  <span class="task-title-sp">Membangun Toko Online Dengan PHP dan MySQL</span>
                  <span class="label label-primary">2015-10-10 07:47:40</span>
                  <div class="pull-right hidden-phone">
                    <button class="btn btn-info btn-xs"><i class="fa fa-check"></i></button>
                    <button class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <?php include "footer.php" ?>