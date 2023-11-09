<?php
require_once 'cek-akses.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
    <title>Tentang Kami - Agriculate</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
  
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
  
    <!-- Ini style custom buat ganti warna hijau -->
    <style> 
    #header {
      background-color: rgb(2, 92, 46, 0.8);
    }
    .breadcrumbs .page-header:before {
      background-color: rgb(2, 92, 46, 0.6);
      }
    .about .section-header h2 .content h3 {
      color: #025c2e;
      }
    @media (max-width: 1279px) {
    .navbar ul {
      background: rgb(2, 92, 46, 0.8);
  }
    .mobile-nav-active .navbar:before {
      background: rgba(45, 45, 45, 0.8);
  }
    .breadcrumbs .page-header:before {
      background-color: rgb(2, 92, 46, 0.6);
    }}
    .testimonials::before {
      background: rgb(2, 92, 46, 0.7);
  }
    #footer {
      background-color: #025c2e;
      }
    </style>
  </head>
  <body>
    <?php include 'menu.php';?>
    <div class="container">
      <?php
      if (isset($_GET['id']) && !empty($_GET['id'])) {
        $pdo = require 'koneksi.php';
        $sql = "SELECT topik.*, users.nama, users.email FROM topik
        INNER JOIN users ON topik.id_user=users.id
        WHERE topik.id=:id";
        $query = $pdo->prepare($sql);
        $query->execute(array('id' => $_GET['id']));
        $topik = $query->fetch();
        if (empty($topik)) {
          echo '<p class="text-warning">Topik tidak ditemukan</p>';
        }else {
          ?>
          <div class="row mb-3">
            <div class="col-auto">
              <img src="//www.gravatar.com/avatar/<?php echo md5($topik['email']);?>?s=48&d=monsterid" class="rounded-circle"/>
            </div>
            <div class="col">
              <div class="fw-bold"><?php echo htmlentities($topik['nama']);?></div>
              <small class="text-muted"><?php echo date('d M Y H:i', strtotime($topik['tanggal']));?></small>
            </div>
          </div>
          <h2><?php echo htmlentities($topik['judul']);?></h2>
          <p><?php echo nl2br(htmlentities($topik['deskripsi']));?></p>
          <hr/>
          <?php
          $sql2 = "SELECT komentar.*, users.nama, users.email FROM komentar
          INNER JOIN users ON users.id = komentar.id_user
          WHERE id_topik=:id_topik";
          $query2 = $pdo->prepare($sql2);
          $query2->execute(array(
            'id_topik' => $_GET['id']
          ));
          while($komentar = $query2->fetch()){
          ?>
          <div class="row mb-3">
            <div class="col-auto">
              <img src="//www.gravatar.com/avatar/<?php echo md5($komentar['email']);?>?s=48&d=monsterid" class="rounded-circle"/>
            </div>
            <div class="col">
              <div class="bg-light py-2 px-3 rounded">
                <div class="row gx-2">
                  <div class="col fw-bold">
                    <?php echo htmlentities($komentar['nama']);?>
                  </div>
                  <?php
                  if ($_SESSION['user']['id'] == $komentar['id_user']) {
                  ?>
                  <div class="col-auto">
                    <a href="hapus-komentar.php?id=<?php echo $komentar['id'];?>"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')"
                    class="text-muted"><small>Hapus</small></a>
                  </div>
                  <?php }?>
                  <div class="col-auto">
                  <small class="text-muted"><?php echo date('d M Y H:i', strtotime($komentar['tanggal']));?></small>
                  </div>
                </div>
                <div class="mt-2">
                  <?php echo nl2br(htmlentities($komentar['komentar']));?>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
          <hr/>
          <div class="row">
            <div class="col-auto">
              <img src="//www.gravatar.com/avatar/<?php echo md5($_SESSION['user']['email']);?>?s=48&d=monsterid" class="rounded-circle"/>
            </div>
            <div class="col">
            <form method="POST" action="jawab-topik.php">
              <div class="mb-3">
                <textarea class="form-control" name="komentar" placeholder="Jawab topik"></textarea>
                <input type="hidden" value="<?php echo $topik['id'];?>" name="id_topik"/>
              </div>
              <div class="text-end">
                <button class="btn btn-primary" type="submit">Kirim</button>
              </div>
            </form>
            </div>
          </div>
          <?php
        }
      }
      ?>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>