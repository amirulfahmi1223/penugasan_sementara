<?php
include "connection/koneksi.php";
if ($_GET['id_foto'] == '') {
  echo '<script>window.location="foto.php"</script>';
}
$foto = mysqli_query($conn, "SELECT * FROM foto INNER JOIN kategori ON foto.id_kategori = kategori.id_kategori WHERE foto.id_foto = '" . $_GET['id_foto'] . "' AND foto.status = 1");
$p = mysqli_fetch_assoc($foto);
$data = mysqli_query($conn, "SELECT YEAR(created_at) AS tahun, DATE(created_at) AS tanggal FROM foto WHERE id_foto = '" . $_GET['id_foto'] . "'");
$d = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Image - Photo Perfect</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" media="print" onload="this.media='all'" />
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" />
  </noscript>
  <link href="css/bootstrap.min.css?ver=1.2.0" rel="stylesheet">
  <link href="css/font-awesome/css/all.min.css?ver=1.2.0" rel="stylesheet">
  <link href="css/main.css?ver=1.2.0" rel="stylesheet">
</head>

<body id="top">
  <div class="page">
    <header>
      <div class="pp-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container"><a href="index.html"><img src="images/favicon.png" alt="Logo"></a><a class="navbar-brand" href="index.php">Photo Perfect</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Container untuk pop-up -->
    <div id="popup-container">
      <span id="close-btn" onclick="closePopup()">&times;</span>
      <img id="popup-img" src="" alt="Pop-up Gambar">
    </div>
    <div class="page-content">
      <div class="container">
        <div class="container pp-section">
          <div class="h3 font-weight-normal">Digital Photography Studio</div>
          <img class="img-fluid mt-4" src="uploads/foto/<?= $p['foto']; ?>" onclick="openPopup('uploads/foto/<?= $p['foto']; ?>')" />
          <div class="row mt-5">
            <div class="col-md-3">
              <div class="h5">Tags</div><a class="mr-1 badge badge-primary" href="#"><?= $p['nama_kategori']; ?></a><a class="mr-1 badge badge-primary" href="#"><?= $p['judul']; ?></a><a class="badge badge-primary" href="#">Flower</a>
              <div class="h5 pt-4">Date</div>
              <p><?= $d['tanggal']; ?></p>
            </div>
            <div class="col-md-9">
              <p><?= $p['deskripsi']; ?></p>

            </div>
          </div>
        </div>
        <div class="pp-section"></div>
      </div>
    </div>
  </div>
  <footer class="pp-footer">
    <div class="container py-5">
      <div class="row text-center">
        <div class="col-md-12"><a class="pp-facebook btn btn-link" href="#"><i class="fab fa-facebook-f fa-2x " aria-hidden="true"></i></a><a class="pp-twitter btn btn-link " href="#"><i class="fab fa-twitter fa-2x " aria-hidden="true"></i></a><a class="pp-youtube btn btn-link" href="#"><i class="fab fa-youtube fa-2x" aria-hidden="true"></i></a><a class="pp-instagram btn btn-link" href="#"><i class="fab fa-instagram fa-2x " aria-hidden="true"></i></a></div>
        <div class="col-md-12">
          <p class="mt-3">Copyright &copy; FahmiCode. All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a></p>
        </div>
      </div>
    </div>
  </footer>
  <style>
    /* Style untuk pop-up */
    #popup-container {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
    }

    #popup-img {
      max-width: 80%;
      max-height: 80%;
    }

    #close-btn {
      position: absolute;
      top: 14px;
      right: 14px;
      cursor: pointer;
      color: white;
      font-size: 40px;
    }

    /* Style untuk gambar thumbnail */
    .thumbnail {
      cursor: pointer;
    }
  </style>
  <script src="scripts/jquery.min.js?ver=1.2.0"></script>
  <script src="scripts/bootstrap.bundle.min.js?ver=1.2.0"></script>
  <script src="scripts/main.js?ver=1.2.0"></script>
  <script>
    // Fungsi untuk membuka pop-up
    function openPopup(imgSrc) {
      // Set src untuk gambar pada pop-up
      document.getElementById('popup-img').src = imgSrc;

      // Tampilkan pop-up
      document.getElementById('popup-container').style.display = 'flex';
    }

    // Fungsi untuk menutup pop-up
    function closePopup() {
      // Sembunyikan pop-up
      document.getElementById('popup-container').style.display = 'none';
    }
  </script>

</body>

</html>