<?php error_reporting(0); ?>
<?php include_once 'atribut/head.php'; ?>

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
                            DATA LOKASI
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                       <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#smallModal">
                                        <i class="material-icons">add</i>
                                        <span>Tambah Data Lokasi</span>
                                    </button>
                                </div>
                                <div class="body table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lokasi Lokasi</th>
                                                    <?php 
                                                    $sql = "SELECT * FROM tb_kriteria_lokasi";
                                                    $query = $connect->query($sql);
                                                    $result = $query->fetch_array();
                                                    $kriteria = json_decode($result['kriteria'], true);             
                                                    ?>
                                                    <th><?= $kriteria[0]['kriteria'] ?></th>
                                                    <th><?= $kriteria[2]['kriteria'] ?></th>
                                                    <th><?= $kriteria[3]['kriteria'] ?></th>
                                                    <th><?= $kriteria[4]['kriteria'] ?></th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                $no = 1;
                                                $sql1 = "SELECT a.id_lokasi, b.nama_lokasi, a.kriteria FROM tb_kriteria_lokasi AS a INNER JOIN tb_lokasi AS b ON b.id_lokasi = a.id_lokasi";
                                                $query = $connect->query($sql1);
                                                while ($row = $query->fetch_array()) {
                                                    $kriteria = json_decode($row['kriteria'], true); ?>

                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['nama_lokasi'] ?></td>
                                                        <td>
                                                            <?php 
                                                            if ($kriteria[0]['weight'] == 4) {
                                                                echo "Latosol";
                                                            } else if ($kriteria[0]['weight'] == 3) {
                                                                echo "Organosol";
                                                            } else if ($kriteria[0]['weight'] == 2) {
                                                                echo "Podzolik";  
                                                            } else if ($kriteria[0]['weight'] == 1) {
                                                                echo "Litosol";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($kriteria[2]['weight'] == 2) {
                                                                echo "Ada";
                                                            } else if ($kriteria[2]['weight'] == 1) {
                                                                echo "Tidak Ada";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($kriteria[3]['weight'] == 4) {
                                                                echo "Basa Sedang (7,5 - 8,5)";
                                                            } else if ($kriteria[3]['weight'] == 3) {
                                                                echo "Netral (7,0 - 7,5)";
                                                            } else if ($kriteria[3]['weight'] == 2) {
                                                                echo "Asam Sedang (4,0 - 6,9)";
                                                            } else if ($kriteria[3]['weight'] == 1) {
                                                                echo "Sangat Asam (< 4)";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($kriteria[4]['weight'] == 2) {
                                                                echo "Dataran Tinggi (500 - 1500 mdpl)";
                                                            } else if ($kriteria[4]['weight'] == 1) {
                                                                echo "Dataran Rendah (0 - 500 mdpl)";
                                                            }
                                                            ?>    
                                                        </td>
                                                        <td>
                                                            <div class='btn-group btn-group-sm' role='group' aria-label='Small button group'>
                                                                <a href='#editmodal' class='btn btn-primary waves-effect' data-toggle='modal' data-id="<?= $row['id_lokasi'] ?>"><i class='material-icons'>edit</i></a>
                                                                <a href='data_kriteria_lokasi_hapus.php?id_lokasi=<?= $row['id_lokasi'] ?>' class='btn btn-danger waves-effect'><i class='material-icons'>delete</i></a>
                                                            </div>
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

        <!-- begin:: modal tambah -->
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="smallModalLabel">Input Data Kriteria Lokasi</h4>
                    </div>
                    <div class="modal-body">


                        <form method="POST">
                            <div class="col-sm-12">

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="inp_namalokasi">
                                            <option>Nama Lokasi</option>
                                            <?php
                                            $sql      = "SELECT * FROM tb_lokasi";
                                            $lokasi = $connect->query($sql);

                                            while ($row = $lokasi->fetch_array(MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $row['id_lokasi'] ?>"><?php echo $row['nama_lokasi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" name="id_kriteria1" value="1" readonly="readonly">
                                        <select class="form-control show-tick" name="kriteria1" id="kriteria1">
                                            <option>Jenis Tanah</option>
                                            <option value="4">Latosol</option>
                                            <option value="3">Organosol</option>
                                            <option value="2">Podzolik</option>
                                            <option value="1">Litosol</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="id_kriteria2" value="2" readonly="readonly">
                                <input type="hidden" name="kriteria2" readonly="readonly" value="Curah Hujan">

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" name="id_kriteria3" value="3" readonly="readonly">
                                        <select name="kriteria3" class="form-control show-tick">
                                            <option>Drainase</option>
                                            <option value="2">Ada</option>
                                            <option value="1">Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" name="id_kriteria4" value="4" readonly="readonly">
                                        <select name="kriteria4" class="form-control show-tick">
                                            <option>PH</option>
                                            <option value="4">Basa Sedang (7,5 - 8,5)</option>
                                            <option value="3">Netral (7,0 - 7,5)</option>
                                            <option value="2">Asam Sedang (4,0 - 6,9)</option>
                                            <option value="1">Sangat Asam (< 4)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" name="id_kriteria5" value="5" readonly="readonly">
                                        <select name="kriteria5" class="form-control show-tick">
                                            <option>Ketinggian Tempat</option>
                                            <option value="2">Dataran Tinggi (500 - 1500 mdpl)</option>
                                            <option value="1">Dataran Rendah (0 - 500 mdpl)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <input type="submit" name="tambah" value="TAMBAH" class="btn btn-link waves-effect">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- end:: modal tambah -->

        <!-- begin:: modal edit -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="smallModalLabel">Ubah Data Lokasi</h4>
                    </div>
                    <div class="modal-body">
                      <div class="hasil-data"></div>  
                  </div>
              </div>
          </div>
      </div>
      <!-- end:: modal edit -->

      <!-- begin:: tombol aktif -->
      <a href="link" id="tombol-modal" data-toggle="modal"></a>
      <!-- end:: tombol aktif -->

      <div class="modal fade" id="modal4" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Latosol</h4>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: justify;">Tanah latosol atau tanah inceptisol merupakan tanah yang mempunyai beberapa ciri atau karakteristik tertentu, yakni :</p>
                        <p style="text-align: justify;">a. Memiliki solum tanah yang agak tebal hingga tebal, yakni mulai sekitar 130 cm hingga lebih dari 5 meter.</p>
                        <p style="text-align: justify;">b. Tanahnya berwarna merah, coklat, hingga kekuning- kuningan.</p>
                        <p style="text-align: justify;">c. Tekstur tanah pada umumnya adalah liat.</p>
                        <p style="text-align: justify;">d. Struktur tanah pada umumnya adalah remah dengan konsistensi gembur.</p>
                        <p style="text-align: justify;">e. Memiliki pH 4,5 hingga 6,5, yakni dari asam hingga agak asam.</p>
                        <p style="text-align: justify;">f. Mengandung unsur hara yang sedang hingga tinggi. Unsur hara yang terkandung di dalam tanah bisa dilihat dari warnanya. Semakin merah warna tanah maka unsur hara yang terkandung adalah semakin sedikit.</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="modal3" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Organosol</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: justify;">Jenis tanah Organosol memiliki ciri sebagai berikut :</p>
                    <p style="text-align: justify;">a. Berwarna kehitaman.</p>
                    <p style="text-align: justify;">b. Mudah basah.</p>
                    <p style="text-align: justify;">c. Sangat subur.</p>
                    <p style="text-align: justify;">d. Mengandung sangat banyak bahan organik.</p>
                    <p style="text-align: justify;">e. Memiliki unsur hara yang rendah.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Podzolik</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: justify;">Jenis tanah Podzolik memiliki karakteristik sebagai berikut :</p>
                    <p style="text-align: justify;">a. Biasanya dimanfaatkan untuk persawahan dan perkebunan.</p>
                    <p style="text-align: justify;">b. Tekstur tanahnya berlempung dan berpasir.</p>
                    <p style="text-align: justify;">c. Memiliki unsur aluminum dan besi yang tinggi.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Litosol</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: justify;">Jenis Tanah Litosol memiliki karakteristik sebagai berikut :</p>
                    <p style="text-align: justify;">a. Mempunyai penampang yang besar, berbentuk kerikil, pasir, dan bebatuan kecil.</p>
                    <p style="text-align: justify;">b. Terbentuk dari proses meletusnya gunung berapi.</p>
                    <p style="text-align: justify;">c. Mempunyai kandungan unsur hara yang sedikit sekali.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>      

</div>
</section>

<?php include_once 'atribut/foot.php'; ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#editmodal').on('show.bs.modal', function (e){
            var id_lokasi = $(e.relatedTarget).data('id');

            $.ajax ({
                type : 'get',
                url : 'data_kriteria_lokasi_ubah.php',
                data : 'id_lokasi='+ id_lokasi,
                success : function(data){
                    $('.hasil-data').html(data);
                }
            }); 
        });

        $('#kriteria1').change(function() {
            var val = $(this).val();
            
            if (val == 4) {
                $('#tombol-modal').attr('href', '#modal4').trigger("click");
            } else if (val == 3) {
                $('#tombol-modal').attr('href', '#modal3').trigger("click");
            } else if (val == 2) {
                $('#tombol-modal').attr('href', '#modal2').trigger("click");
            } else if (val == 1) {
                $('#tombol-modal').attr('href', '#modal1').trigger("click");
            }

        });

    });
</script>

<?php 

if (isset($_POST['tambah'])) {

    $nm_lokasi = $_POST['inp_namalokasi'];

    $sql = "SELECT * FROM tb_kriteria_lokasi WHERE id_lokasi = '$nm_lokasi'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

        echo "<script>
        alert('Ada')
        window.location=(href='data_kriteria_lokasi.php')
        </script>";

    } else {

        $array_kriteria = array(
            ['id_kriteria' => $_POST['id_kriteria1'], 'kriteria' => 'Jenis Tanah', 'weight' => $_POST['kriteria1']],
            ['id_kriteria' => $_POST['id_kriteria2'], 'kriteria' => 'Curah Hujan', 'weight' => ''],
            ['id_kriteria' => $_POST['id_kriteria3'], 'kriteria' => 'Drainase', 'weight' => $_POST['kriteria3']],
            ['id_kriteria' => $_POST['id_kriteria4'], 'kriteria' => 'pH', 'weight' => $_POST['kriteria4']],
            ['id_kriteria' => $_POST['id_kriteria5'], 'kriteria' => 'Ketinggian Tempat', 'weight' => $_POST['kriteria5']]
        );
        $data_kriteria = json_encode($array_kriteria);
        $query  = "INSERT INTO tb_kriteria_lokasi (id_lokasi, kriteria) VALUES ('$nm_lokasi', '$data_kriteria')";
        $result = $connect->query($query);

        if ($result) {
            echo "<script>
            alert('Berhasil')
            window.location=(href='data_kriteria_lokasi.php')
            </script>";
        }

        else {
            echo "<script>
            alert('Gagal')
            window.location=(href='data_kriteria_lokasi.php')
            </script>";
        }

    }

} else if (isset($_POST['ubah'])) {

    $id_lokasi = $_POST['id_lokasi'];
    $nm_lokasi = $_POST['inp_namalokasi'];

    $array_kriteria = array(
        ['id_kriteria' => $_POST['id_kriteria1'], 'kriteria' => 'Jenis Tanah', 'weight' => $_POST['kriteria1']],
        ['id_kriteria' => $_POST['id_kriteria2'], 'kriteria' => 'Curah Hujan', 'weight' => ''],
        ['id_kriteria' => $_POST['id_kriteria3'], 'kriteria' => 'Drainase', 'weight' => $_POST['kriteria3']],
        ['id_kriteria' => $_POST['id_kriteria4'], 'kriteria' => 'pH', 'weight' => $_POST['kriteria4']],
        ['id_kriteria' => $_POST['id_kriteria5'], 'kriteria' => 'Ketinggian Tempat', 'weight' => $_POST['kriteria5']]
    );
    $data_kriteria = json_encode($array_kriteria);
    
    $query  = "UPDATE tb_kriteria_lokasi SET kriteria = '$data_kriteria' WHERE id_lokasi = '$id_lokasi' ";
    $result = $connect->query($query);

    if ($result) {
        echo "<script>
        alert('Berhasil')
        window.location=(href='data_kriteria_lokasi.php')
        </script>";
    }

    else {
        echo "<script>
        alert('Gagal')
        window.location=(href='data_kriteria_lokasi.php')
        </script>";
    }
}

?>