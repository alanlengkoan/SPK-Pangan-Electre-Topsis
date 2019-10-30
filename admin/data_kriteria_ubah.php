<?php include_once 'atribut/head.php'; ?>

<?php 
$id_kriteria = $_GET['id_kriteria'];
$sql      = "SELECT * FROM tb_kriteria WHERE id_criteria = '$id_kriteria'";
$query    = $connect->query($sql);
$row      = $query->fetch_array(MYSQLI_ASSOC);
$kriteria = json_decode($row['bulan'], true);
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
                            Ubah Data Kriteria
                        </h2>
                    </div>
                    <div class="body">
                        <form method="POST">
                            <div class="col-sm-12">
                                <label>Nama Kriteria</label>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nm_kriteria" value="<?= $row['criteria'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php for ($i = 0; $i < count($kriteria); $i++) { ?>
                                    <!-- begin:: kriteria 1 curah hujan -->
                                    <label><?= $kriteria[$i]['bulan'] ?></label>
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="hidden" name="id_bulan[]" value="<?= $kriteria[$i]['id_bulan'] ?>" />
                                                    <input type="hidden" name="nm_bulan[]" value="<?= $kriteria[$i]['bulan'] ?>" />
                                                    <input type="text" class="form-control" name="value[]" value="<?= $kriteria[$i]['value'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end:: kriteria 1 curah hujan -->
                                <?php } ?>
                            </div>
                            <input type="submit" name="ubah" value="UBAH" class="btn btn-link waves-effect">
                            <a href="data_kriteria.php"><button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button></a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include_once 'atribut/foot.php'; ?>

<?php 
if (isset($_POST['ubah'])) {

    $nm_kriteria = $_POST['nm_kriteria'];
    $id_bulan = $_POST['id_bulan'];
    $nm_bulan = $_POST['nm_bulan'];
    $vl_bulan = $_POST['value'];

    $array_bulan = array();
    for ($i = 0; $i < count($id_bulan); $i++) { 
        $array_bulan[] = [
            'id_bulan' => $id_bulan[$i],
            'bulan'    => $nm_bulan[$i],
            'value'    => $vl_bulan[$i]
        ];
    }
    $data_bulan = json_encode($array_bulan);
    
    $query  = "UPDATE tb_kriteria SET criteria = '$nm_kriteria', bulan = '$data_bulan' WHERE id_criteria = '$id_kriteria' ";
    $result = $connect->query($query);

    if ($result) {
        echo "<script>
        alert('Berhasil')
        window.location=(href='data_kriteria.php')
        </script>";
    }

    else {
        echo "<script>
        alert('Gagal')
        window.location=(href='data_kriteria.php')
        </script>";
    }
}
?>