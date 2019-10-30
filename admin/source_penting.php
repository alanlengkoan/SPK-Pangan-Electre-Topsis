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

$bulan1 = date($id_bulan);
$bulan2 = date($id_bulan) + 1;
$bulan3 = date($id_bulan) + 2;

    // echo bulan(date($id_bulan));
    // echo "<br>";
    // echo bulan(date($id_bulan) + 1);
    // echo "<br>";
    // echo bulan(date($id_bulan) + 2);
    // echo "<br>";


    [{"id_kriteria":"1","kriteria":"Jenis Tanah","weight":"4"},{"id_kriteria":"2","kriteria":"Curah Hujan","weight":1,"bulan1":"250","bulan2":"210","bulan3":"20","ket":"Rendah (100-200 mm/bulan)"},{"id_kriteria":"3","kriteria":"Drainase","weight":"2"},{"id_kriteria":"4","kriteria":"pH","weight":"3"},{"id_kriteria":"5","kriteria":"Ketinggian Tempat","weight":"1"}]

    // $bulan1 = $_POST['bulan1'];
    // $bulan2 = $_POST['bulan2'];
    // $bulan3 = $_POST['bulan3'];
    // $ket    = $_POST['kriteria2'];

    // $hitung = ($bulan1+$bulan2+$bulan3)/3;
    
    // if ($hitung >= 300 && $hitung <= 400) {
    //     $hasil = 3;
    // } else if ($hitung >= 200 && $hitung <= 300) {
    //     $hasil = 2;
    // } else if ($hitung >= 100 && $hitung <= 200) {
    //     $hasil = 1;
    // }


        // $("#outbulan3").keyup(function() {
        //     var bulan1 = $('#outbulan1').val();
        //     var bulan2 = $('#outbulan2').val();
        //     var bulan3 = $(this).val();

        //     var hitung = (parseInt(bulan1)+parseInt(bulan2)+parseInt(bulan3))/3;

        //     if (hitung >= 300 && hitung <= 400) {
        //         $('#kriteria2').val('Tinggi (300-400 mm/bulan)');
        //     } else if (hitung >= 200 && hitung <= 300) {
        //         $('#kriteria2').val('Menengah (200-300 mm/bulan)');
        //     } else if (hitung >= 100 && hitung <= 200) {
        //         $('#kriteria2').val('Rendah (100-200 mm/bulan)');
        //     } 
        // });

        <!-- begin:: kriteria 1 curah hujan -->
                                                            <!-- <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" value="<?php echo date('F') ?>" readonly="readonly" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="bulan1" id="outbulan1" placeholder="Bulan 1" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" value="<?php echo date('F', mktime(0,0,0, date('m')+1)) ?>" readonly="readonly" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="bulan2" id="outbulan2" placeholder="Bulan 2" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" value="<?php echo date('F', mktime(0,0,0, date('m')+2)) ?>" readonly="readonly" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="bulan3" id="outbulan3" placeholder="Bulan 3" class="form-control">
                                                                </div>
                                                            </div> -->


                                                            <!-- Jquery Core Js -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#editmodal').find('#outbulan3').val(<?= $kriteria[1]['bulan1'] ?>);
        $('#editmodal').find('#outbulan4').val(<?= $kriteria[1]['bulan2'] ?>);
        $('#editmodal').find('#outbulan5').val(<?= $kriteria[1]['bulan3'] ?>);

        $("#outbulan5").keyup(function() {
            var bulan1 = $('#editmodal').find('#outbulan3').val();
            var bulan2 = $('#editmodal').find('#outbulan4').val();
            var bulan3 = $(this).val();

            var hitung = (parseInt(bulan1)+parseInt(bulan2)+parseInt(bulan3))/3;

            if (hitung >= 300 && hitung <= 400) {
                $('#editmodal').find('#kriteria2').val('Tinggi (300-400 mm/bulan)');
            } else if (hitung >= 200 && hitung <= 300) {
                $('#editmodal').find('#kriteria2').val('Menengah (200-300 mm/bulan)');
            } else if (hitung >= 100 && hitung <= 200) {
                $('#editmodal').find('#kriteria2').val('Rendah (100-200 mm/bulan)');
            }
        });

    });
</script>

<!-- begin:: kriteria 1 curah hujan -->
        <label>Curah Hujan</label>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" value="<?php echo date('F') ?>" readonly="readonly" class="form-control">
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" name="bulan1" id="outbulan3" class="form-control">
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" value="<?php echo date('F', mktime(0,0,0, date('m')+1)) ?>" readonly="readonly" class="form-control">
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" name="bulan2" id="outbulan4" class="form-control">
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" value="<?php echo date('F', mktime(0,0,0, date('m')+2)) ?>" readonly="readonly" class="form-control">
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" name="bulan3" id="outbulan5" class="form-control">
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="kriteria2" id="kriteria2" value="<?= $kriteria[1]['ket'] ?>" readonly="readonly" class="form-control show-tick" value="Curah Hujan">
            </div>
        </div>
        <!-- end:: kriteria 1 curah hujan -->


          // while (      
  //   for ($i=0; $i < count($kriteria) ; $i++) { 
  //     $criteria[$kriteria[$i]['id_kriteria']] = $kriteria[$i]['weight'];
  //   }
  //   $bulan = array(
  //     $kriteria[1]['bulan1'],
  //     $kriteria[1]['bulan2'],
  //     $kriteria[1]['bulan3']
  //   );
  // }

  if (isset($_POST['cetak'])) {
      $nm_lokasi = $_POST['nm_lokasi'];
      $hasil_akhir1 = json_encode($hasil1);
      $hasil_akhir2 = json_encode($hasil2);

      $sql    = "SELECT * FROM tb_ranking WHERE id_lokasi = '$nm_lokasi' ";
      $tambah = mysqli_query($connect, $sql);

      if ($row = mysqli_fetch_row($tambah)) {

        $sql   = "DELETE FROM tb_ranking WHERE id_lokasi = '$nm_lokasi'";
        $query = mysqli_query($connect, $sql);
        $sql2 = "INSERT INTO tb_ranking (id_lokasi, hasil_electre, hasil_topsis) VALUES ('$nm_lokasi', '$hasil_akhir1', '$hasil_akhir2')";
        $query = mysqli_query($connect, $sql2);

        if ($query) {
          echo "<script>
          alert('Berhasil')
          window.location=(href='cetak_hasil.php?nm_lokasi=".$nm_lokasi."')
          </script>";
        } else  {
         echo "<script>
         alert('Gagal')
         </script>";
       }

     } else {
      
      $sql = "INSERT INTO tb_ranking (id_lokasi, hasil_electre, hasil_topsis) VALUES ('$nm_lokasi', '$hasil_akhir1', '$hasil_akhir2')";
      $query = $connect->query($sql);

      if ($query) {
        echo "<script>
        alert('Berhasil')
        window.location=(href='cetak_hasil.php?nm_lokasi=".$nm_lokasi."')
        </script>";
      } else  {
       echo "<script>
       alert('Gagal')
       </script>";
     }

   }
 }