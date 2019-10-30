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
                                            <span>Tambah Tanaman</span>
                                        </button> 
                                        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="smallModalLabel">Input Nama Tanaman</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php 
                                                        $query = "SELECT max(id_alternative) as maxKode FROM tb_alternatif";
                                                        $hasil = mysqli_query($connect,$query);
                                                        $data = mysqli_fetch_array($hasil);
                                                        $kodeOtomatis = $data['maxKode'];
                                                        $noUrut = (int) substr($kodeOtomatis, 0, 3);
                                                        $noUrut++;
                                                        $kodeOtomatis = $noUrut;
                                                        ?>

                                                        <form method="POST">
                                                            <div class="col-sm-12">
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <input type="hidden" name="inp_idalternative" value="<?php echo $kodeOtomatis; ?>" />
                                                                        <input type="text" class="form-control" name="inp_tan" required="required">
                                                                        <label class="form-label">Nama Tanaman</label>
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


                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Tanaman</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                $sql = "SELECT * FROM tb_alternatif";
                                                $query = $connect->query($sql);

                                                while ($row = $query->fetch_array()) {
                                                    echo "<tr>";
                                                    echo "<td>".$no++."</td>";
                                                    echo "<td>".$row['name']."</td>";
                                                    echo "<td>
                                                    <div class='btn-group btn-group-sm' role='group' aria-label='Small button group'>
                                                    <a href='#editmodal' class='btn btn-primary waves-effect' data-toggle='modal' data-id=".$row['id_alternative']."><i class='material-icons'>edit</i>Ubah</a>
                                                    <a href='data_tanaman_hapus.php?id_tanaman=".$row['id_alternative']."' class='btn btn-danger waves-effect'><i class='material-icons'>delete</i>Hapus</a>
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
            var id_tanaman = $(e.relatedTarget).data('id');

            $.ajax ({
                type : 'get',
                url : 'data_tanaman_ubah.php',
                data : 'id_tanaman='+ id_tanaman,
                success : function(data){
                    $('.hasil-data').html(data);
                }
            });
        });
    });
</script>

<?php 

if (isset($_POST['tambah'])) {
    $id_alternative = $_POST['inp_idalternative'];
    $nama_tanaman = $_POST['inp_tan'];

    $query  = "INSERT INTO tb_alternatif (id_alternative, name) VALUES ('$id_alternative', '$nama_tanaman')";
    $result = $connect->query($query);

    if ($result) {
        echo "<script>
        alert('Berhasil')
        window.location=(href='data_tanaman.php')
        </script>";
    }

    else {
        echo "<script>
        alert('Gagal')
        window.location=(href='data_tanaman.php')
        </script>";
    }
} else if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama_tanaman = $_POST['nm_tanaman'];

    $query  = "UPDATE tb_alternatif SET name = '$nama_tanaman' WHERE id_alternative = '$id' ";
    $result = $connect->query($query);

    if ($result) {
        echo "<script>
        alert('Berhasil')
        window.location=(href='data_tanaman.php')
        </script>";
    }

    else {
        echo "<script>
        alert('Gagal')
        window.location=(href='data_tanaman.php')
        </script>";
    }
}

?>
