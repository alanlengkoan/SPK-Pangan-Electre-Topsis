<?php
// untuk koneksi ke database
include_once 'database/koneksi.php';
session_start();

if(isset($_POST["masuk"])) {

  $user = $_POST['inpusername'];
  $pass = $_POST['inppassword'];

  $sql    = "SELECT * FROM tb_user WHERE username = '$user'";
  $result = $connect->query($sql);
    // cek username
  if ($result->num_rows > 0) {

        // cek password
    $row = $result->fetch_array(MYSQLI_ASSOC);
    // untuk mengecek username
    if ($row['username'] == $user) {
            // untuk mengecek password
      if (password_verify($pass, $row["password"])) {
                // untuk mengecek level user
        if ($row['level'] == 'admin') {
                  // set session
          $_SESSION["inpusername"] = $user;
          $_SESSION["level"]       = 'admin';
          header("location: admin/index.php");
          exit;
        }
      } else {
        $inppassword = true;
      }
    }
  } else {
    $inpuserornpm = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistem Pendukung Keputusan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="assets/fonts/icomoon/style.css">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="assets/css/aos.css">
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

   
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="index.php">SPK PANGAN</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="index.php" class="nav-link">Beranda</a></li>
                <li><a href="konsul.php" class="nav-link">Konsul</a></li>
                <li><a href="history.php" class="nav-link">History</a></li>
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
    </header>

    <div class="intro-section" id="home-section">
      
      <div class="slide-1" style="background-image: url('assets/images/hero_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">Learn From The Expert</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ipsa nulla sed quis rerum amet natus quas necessitatibus.</p>
                  <p data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-primary py-3 px-5 btn-pill">Admission Now</a></p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  
                  <?php
                  if (isset($inpuserornpm)) {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Username atau Password yang Anda masukkan tidak terdaftar.
                    </div>
                    ';
                  } else if (isset($inppassword)) {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Password yang Anda masukkan salah!
                    </div>
                    ';
                  } else if (isset($_GET['masuk'])) {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> untuk mengakses Anda harus login terlebih dahulu.
                    </button>
                    </div>
                    ';
                  } else if (isset($_GET['admin'])) {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> untuk mengakses Anda harus login terlebih dahulu.
                    </div>
                    ';
                  }
                  ?>

                  <form method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Login</h3>
                    <div class="form-group">
                      <input type="text" name="inpusername" class="form-control" placeholder="Username" required="required" />
                    </div>
                    <div class="form-group">
                      <input type="password" name="inppassword" class="form-control" placeholder="Password" required="required" />
                    </div>
                    <div class="form-group">
                      <input type="submit" name="masuk" class="btn btn-primary btn-pill" value="Masuk">
                    </div>
                  </form>

                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>  
    
  </div> <!-- .site-wrap -->

  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/jquery-ui.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/jquery.countdown.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/jquery.fancybox.min.js"></script>
  <script src="assets/js/jquery.sticky.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>