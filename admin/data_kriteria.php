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
                            Data Kriteria
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
                                                    <th>Nama Kriteria</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                $sql = "SELECT * FROM tb_kriteria";
                                                $query = $connect->query($sql);

                                                while ($row = $query->fetch_array()) {
                                                    echo "<tr>";
                                                    echo "<td>".$no++."</td>";
                                                    echo "<td>".$row['criteria']."</td>";
                                                    echo "<td><a href='data_kriteria_ubah.php?id_kriteria=".$row['id_criteria']."' class='btn btn-danger'>Ubah</a></td>";
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#editmodal').on('show.bs.modal', function (e){
            var id_lokasi = $(e.relatedTarget).data('id');

            $.ajax ({
                type : 'get',
                url : 'data_lokasi_ubah.php',
                data : 'id_lokasi='+ id_lokasi,
                success : function(data){
                    $('.hasil-data').html(data);
                }
            });
        });
    });
</script>
