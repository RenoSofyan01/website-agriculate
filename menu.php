<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <!-- <h1>Logis</h1> -->
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html">Beranda</a></li>
          <li><a href="Kemitraan.html">Kemitraan</a></li>
          <li><a href="forum.html">Forum</a></li>
          <li><a href="about.html" >Tentang Kami</a></li>
          <li><a href="index.php">Daftar / Masuk</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <div style="text-align: center; margin-top: 130px;" >
        <?php
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        ?>
          <button class="btn btn-dark <?php echo $__menuAktif == 'registrasi' ? 'active' : ''?>" onclick="window.location.href='daftar.php'" >Daftar</button>
          <button class="btn btn-dark <?php echo $__menuAktif == 'login' ? 'active' : ''?>" onclick="window.location.href='login.php'">Masuk</button>
        <?php } else {
          if ($_SESSION['user']['nama'] === 'admin') {
            // Admin dapat mem-post topik
            echo '<button class="btn btn-dark" onclick="window.location.href=\'tambah-topik.php\'">Post Topik</button>';
          }
          echo '<button class="btn btn-dark onclick="window.location.href=\'profil.php\'">Profil</button>';
          echo '<button class="btn btn-dark" onclick="window.location.href=\'logout.php\'">Logout</button>';
        }
        ?>
      </div>
