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
                                PROSES ALGORITMA
                            </h2>
                        </div>
                        <div class="body">
                            <form action="hasil_metode.php" method="POST">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label>Nama Lokasi</label>
                                        <input type="hidden" name="kriteria" value="<?php echo $id_criteria ?>" readonly="readonly">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="nm_lokasi">
                                                    <option>Pilih Lokasi</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tb_lokasi";
                                                    $tanaman = $connect->query($sql);
                                                    while ($row = $tanaman->fetch_array(MYSQLI_ASSOC)) {
                                                        ?>
                                                        <option value="<?php echo $row['id_lokasi'] ?>"><?php echo $row['nama_lokasi']; ?></option>
                                                        <?php

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Bulan</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="id_bulan">
                                                    <option>Pilih Bulan</option>
                                                    <?php
                                                    $sql      = "SELECT * FROM tb_kriteria WHERE id_criteria = '2'";
                                                    $query    = $connect->query($sql);
                                                    $row      = $query->fetch_array(MYSQLI_ASSOC);
                                                    $kriteria = json_decode($row['bulan'], true);
                                                    for ($i = 0; $i < count($kriteria); $i++) { ?>
                                                        <option value="<?= $kriteria[$i]['id_bulan'] ?>"><?= $kriteria[$i]['bulan'] ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="proses" value="Proses" class="btn btn-link btn-primary waves-effect">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once 'atribut/foot.php'; ?>