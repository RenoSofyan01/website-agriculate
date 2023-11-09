<?php
session_start();
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
      
      <?php
      $__menuAktif = 'home';
      include 'menu.php';
      ?>
      <div class="container">
        <h1>
          <?php
          if (isset($_SESSION['user'])) {
            echo $_SESSION['user']['nama'];
          }
          ?>
        </h1>
        <?php
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
          $pdo = require 'koneksi.php';
          $sql = "SELECT judul, tanggal, nama, email, topik.id, id_user FROM topik
          INNER JOIN users ON topik.id_user = users.id
          ORDER BY tanggal DESC";
          $query = $pdo->prepare($sql);
          $query->execute();
        ?>
        <h3 class="mt-5">Daftar Topik</h3>
        <hr/>
        <?php
        while($data = $query->fetch()) {
        ?>
        <div class="row">
          <div class="col-auto">
            <img src="//www.gravatar.com/avatar/<?php echo md5($data['email']);?>?s=48&d=monsterid" class="rounded-circle"/>
          </div>
        <figure class="col">
          <blockquote class="blockquote">
            <p>
              <a href="lihat-topik.php?id=<?php echo $data['id'];?>"><?php echo htmlentities($data['judul']);?></a>
            </p>
          </blockquote>
          <figcaption class="blockquote-footer">
            Dari: <?php echo htmlentities($data['nama']);?>
            - <?php echo date('d M Y H:i', strtotime($data['tanggal']));?>
            <?php
            if ($_SESSION['user']['id'] == $data['id_user']) {?>
            - <a href="hapus-topik.php?id=<?php echo $data['id'];?>"
                onclick="return confirm('Apakah Anda yakin menghapus topik ini?')"
                class="text-muted">Hapus</a>
            <?php }?>
          </figcaption>
        </figure>
        </div>
        <?php }?>
        <?php }?>
      </div>
    <script src="boostrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>