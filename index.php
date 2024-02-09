<?php
include "connection/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Photo Perfect</title>
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
          <div class="container"><a href="index.php"><img src="images/favicon.png" alt="Logo"></a><a class="navbar-brand" href="index.php">Photo Perfect</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a class="nav-link" href="index.php">Home</a>
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
    <div class="page-content">
      <div class="container">
        <div class="container pp-section">
          <div class="row">
            <div class="col-md-9 col-sm-12 px-0">
              <h1 class="h3"> We are Photo Perfect, A Digital Photography Studio.</h1>
            </div>
          </div>
        </div>
        <div class="container px-0 py-4">
          <div class="pp-category-filter">
            <div class="row">
              <div class="col-sm-12"><a class="btn btn-primary pp-filter-button" href="#" data-filter="all">All</a>
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                while ($k = mysqli_fetch_assoc($kategori)) { ?>
                  <!-- data filter untuk memanggil datagroup -->
                  <a class="btn btn-outline-primary pp-filter-button" href="#" data-filter="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="container px-0">
          <div class="pp-gallery">
            <div class="card-columns">
              <?php
              $foto = mysqli_query($conn, "SELECT * FROM foto INNER JOIN kategori ON foto.id_kategori = kategori.id_kategori WHERE foto.status = 1");
              if (mysqli_num_rows($foto) > 0) {
                while ($p = mysqli_fetch_array($foto)) {
              ?>
                  <!-- datagroup untuk data yang dipangggil filter data yg ditampilkan -->
                  <div class="card" data-groups="[&quot;<?= $p['nama_kategori']; ?>&quot;]">
                    <a href="image-detail.php?id_foto=<?= $p['id_foto']; ?>" alt="<?= $p['nama_kategori']; ?>" class="fancylight popup-btn" data-fancybox-group="light">
                      <figure class="pp-effect"><img class="img-fluid" src="uploads/foto/<?= $p['foto']; ?>" alt="<?= $p['nama_kategori']; ?>" onclick="openPopup('uploads/foto/<?= $p['foto']; ?>')" />
                        <figcaption>
                          <div class="h4 text-uppercase"><?= $p['judul']; ?></div>
                          <p><?= $p['nama_kategori']; ?></p>
                        </figcaption>
                      </figure>
                    </a>
                  </div>
                <?php
                }
              } else { ?>
                <p class="text-center">Tidak Ada Foto</p>
              <?php } ?>
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
    <script src="scripts/jquery.min.js?ver=1.2.0"></script>
    <script src="scripts/bootstrap.bundle.min.js?ver=1.2.0"></script>
    <script src="scripts/main.js?ver=1.2.0"></script>
</body>

</html>