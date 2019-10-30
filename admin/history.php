<?php include_once 'atribut/head.php'; ?>

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

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>

<!-- Untuk Menu -->
<?php include_once 'atribut/menu.php'; ?>

<section class="content">
    <div class="container-fluid">

        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            LOKASI PENANAMAN
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>No</th>
                                                  <th>Nama Pengunjungan</th>
                                                  <th>Tanggal Akses</th>
                                                  <th>Lokasi</th>
                                                  <th>Bulan</th>
                                                  <th>Alamat</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                            $no = 1;
                                            $data = $connect->query('SELECT tb_history.*, tb_lokasi.nama_lokasi FROM tb_history INNER JOIN tb_lokasi ON tb_history.lokasi = tb_lokasi.id_lokasi ORDER BY id_history');
                                            while ($row = $data->fetch_array(MYSQLI_ASSOC)) { ?>
                                              <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $row['nama'] ?></td>
                                                <td><?= $row['tgl_akses'] ?></td>
                                                <td><?= $row['nama_lokasi'] ?></td>
                                                <td><?= bulan($row['bulan']).", ".bulan(date($row['bulan']) + 1).", ".bulan(date($row['bulan']) + 2) ?></td>
                                                <td><?= $row['alamat'] ?></td>
                                                <td>
                                                  <a href="history_detail.php?id_history=<?= $row['id_history'] ?>" class='btn btn-primary waves-effect' target="_blank"> <i class="material-icons">info</i> </a>
                                                  <a href="history_cetak.php?id_history=<?= $row['id_history'] ?>" class='btn btn-info waves-effect' target="_blank"> <i class="material-icons">print</i> </a>
                                                  <a href="history_hapus.php?id_history=<?= $row['id_history'] ?>" class='btn btn-danger waves-effect'> <i class="material-icons">delete</i> </a>
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
</div>

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Ubah Lokasi Penanaman</h4>
            </div>
            <div class="modal-body">

              <div class="hasil-data"></div>  

          </div>
      </div>
  </div>
</div>
</div>
</section>

<?php include_once 'atribut/foot.php'; ?>