<?php include_once 'database/koneksi.php'; ?>

<?php 
function bulan($bulan)
{
  Switch ($bulan){
    case 1 : $bulan="Januari";
    Break;
    case 2 : $bulan="Februari";
    Break;
    case 3 : $bulan="Maret";
    Break;
    case 4 : $bulan="April";
    Break;
    case 5 : $bulan="Mei";
    Break;
    case 6 : $bulan="Juni";
    Break;
    case 7 : $bulan="Juli";
    Break;
    case 8 : $bulan="Agustus";
    Break;
    case 9 : $bulan="September";
    Break;
    case 10 : $bulan="Oktober";
    Break;
    case 11 : $bulan="November";
    Break;
    case 12 : $bulan="Desember";
    Break;
  }
  return $bulan;
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

    <header class="site-navbar py-4 js-sticky-header site-navbar-target" style="background-color: #4baea0" role="banner">

      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="index.php">SPK PANGAN</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block m-0 p-0">
                <li>
                  <a href="index.php" class="nav-link">Beranda</a>
                </li>
                <li>
                  <a href="konsul.php" class="nav-link">Konsul</a>
                </li>
                <li>
                  <a href="history.php" class="nav-link">History</a>
                </li>
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="site-section">
      <div class="container">
        <div class="row mt-5 justify-content-center">
          <div class="col-lg-12">
            <h4 class="text-center" style="color: #000">Silahkan isi form dibawah</h4>
            
            <div class="card">
              <div class="card-header">
                Data History
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Tanggal Akses</th>
                        <th>Lokasi</th>
                        <th>Bulan</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; $data = $connect->query('SELECT tb_history.*, tb_lokasi.nama_lokasi FROM tb_history INNER JOIN tb_lokasi ON tb_history.lokasi = tb_lokasi.id_lokasi ORDER BY id_history'); while ($row = $data->fetch_array(MYSQLI_ASSOC)) { ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['tgl_akses'] ?></td>
                          <td><?= $row['nama_lokasi'] ?></td>
                          <td><?= bulan($row['bulan']).", ".bulan(date($row['bulan']) + 1).", ".bulan(date($row['bulan']) + 2) ?></td>
                          <td><?= $row['alamat'] ?></td>
                          <td>
                            <a href="history_detail.php?id_history=<?= $row['id_history'] ?>" target="_blank">Detail</a>
                            <a href="history_cetak.php?id_history=<?= $row['id_history'] ?>" target="_blank">Cetak</a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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