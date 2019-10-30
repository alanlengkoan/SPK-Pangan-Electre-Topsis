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
                            DATA TANAMAN
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                       <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#smallModal">
                                        <i class="material-icons">add</i>
                                        <span>Tambah Data Tanaman</span>
                                    </button> 
                                </div>
                                <div class="body table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                             <th>No</th>
                                             <th>Alternatif</th>
                                             <th>Kriteria</th>
                                             <th>Nilai</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                        <?php

                                        $no    = 1;
                                        $sql   = "SELECT  tb_alternatif.`name`, tb_kriteria.criteria, tb_kriteria.id_criteria, tb_evaluasi.`value`, tb_evaluasi.id_alternative FROM tb_evaluasi
                                        INNER JOIN tb_alternatif ON tb_evaluasi.id_alternative = tb_alternatif.id_alternative
                                        INNER JOIN tb_kriteria ON tb_evaluasi.id_criteria = tb_kriteria.id_criteria ORDER BY tb_evaluasi.id_alternative ASC,tb_evaluasi.id_criteria ASC";
                                        $query = $connect->query($sql);
                                        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {

                                            echo "<tr>";
                                            echo "<td>".$no++."</td>";
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['criteria']."</td>";
                                            echo "<td>".$row['value']."</td>";
                                            echo "<td>
                                            <div class='btn-group btn-group-sm' role='group' aria-label='Small button group'>
                                            <a href='data_kriteria_tanaman_ubah.php?id_alternatif=".$row['id_alternative']."&id_kriteria=".$row['id_criteria']."' class='btn btn-primary waves-effect'><i class='material-icons'>edit</i>Ubah</a>
                                            </div>
                                            </td>";
                                            echo "</tr>";

                                        }

                                        ?>

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

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Input Kriteria Tanaman</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select class="form-control show-tick" name="nm_tanaman">
                                <option>Nama Tanaman</option>
                                <?php
                                $sql      = "SELECT * FROM tb_alternatif";
                                $tanaman = $connect->query($sql);

                                while ($row = $tanaman->fetch_array(MYSQLI_ASSOC)) {
                                    ?>
                                    <option value="<?php echo $row['id_alternative'] ?>"><?php echo $row['name']; ?></option>
                                    <?php

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" name="id_kriteria1" value="1" readonly="readonly">
                            <select class="form-control show-tick" name="kriteria1">
                                <option>Jenis Tanah</option>
                                <option value="4">Latosol</option>
                                <option value="3">Organosol</option>
                                <option value="2">Podzolik</option>
                                <option value="1">Litosol</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" name="id_kriteria2" value="2" readonly="readonly">
                            <select name="kriteria2" class="form-control show-tick">
                                <option>Curah Hujan</option>
                                <option value="3">Tinggi (300-400 mm/bulan)</option>
                                <option value="2">Menengah (200-300 mm/bulan)</option>
                                <option value="1">Rendah (100-200 mm/bulan)</option>
                            </select>
                        </div>
                    </div>
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
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                    <input type="submit" name="tambah" value="TAMBAH" class="btn btn-link waves-effect">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</section>

<?php include_once 'atribut/foot.php'; ?>

<?php 

if (isset($_POST['tambah'])) {
    $nama_tanaman = $_POST['nm_tanaman'];
    $kriteria = $_POST['kriteria'];
    $value = $_POST['value'];

    for ($i=0; $i < count($kriteria); $i++) { 
        $query  = "INSERT INTO tb_evaluasi (id_alternative, id_criteria, value) VALUES ('$nama_tanaman','$kriteria[$i]','$value[$i]')";
        $result = $connect->query($query);
    }

    if ($result) {
        echo "<script>
        alert('Berhasil')
        window.location=(href='data_kriteria_tanaman.php')
        </script>";
    }

    else {
        echo "<script>
        alert('Gagal')
        window.location=(href='data_kriteria_tanaman.php')
        </script>";
    }
}

?>