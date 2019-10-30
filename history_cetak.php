<?php
// untuk koneksi
include_once 'database/koneksi.php';
ob_start();
$id_history = $_GET['id_history'];
$get_data = "SELECT tb_history.*, tb_lokasi.nama_lokasi FROM tb_history INNER JOIN tb_lokasi ON tb_history.lokasi = tb_lokasi.id_lokasi WHERE id_history = '$id_history' ";
$q_data   = $connect->query($get_data);
$s_data   = $q_data->fetch_array(MYSQLI_ASSOC);

$nma_pengunjung = $s_data['nama'];
$nma_lokasi     = $s_data['nama_lokasi'];
$nma_bulan      = bulan($s_data['bulan']);
$id_lokasi      = $s_data['lokasi'];
$id_bulan       = $s_data['bulan'];
$alamat         = $s_data['alamat'];

$sql = "SELECT * FROM tb_ranking WHERE id_lokasi = '$id_lokasi'";
$query = $connect->query($sql);
$hasil = $query->fetch_array(MYSQLI_ASSOC);


$sql2 = "SELECT * FROM tb_alternatif";
$result2 = $connect->query($sql2);

$tanaman = array();
$alternatif = array();
$namatanaman = array();

while($row = $result2->fetch_row()){
  $tanaman[$row[0]] = $row[0]; 
  $namatanaman[$row[0]] = $row[1];
  $alternatif[$row[0]]=array($row[1]);
}

$sql3 = "SELECT id_criteria, criteria FROM tb_kriteria";
$result3 = $connect->query($sql3);

$j_kriteria = [];
while ($rs = $result3->fetch_array(MYSQLI_ASSOC)) {
  $j_kriteria[] = $rs['criteria'];
}

$sql4 = "SELECT nama_lokasi FROM tb_lokasi WHERE id_lokasi = '$id_lokasi'";
$result4 = $connect->query($sql4);
$nm_lok = $result4->fetch_array();

$tgl        = date("d");
$arr_bulan1 = array(1=>"I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
$arr_bulan2 = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulan1     = $arr_bulan1[date("n")];
$bulan2     = $arr_bulan2[date("n")];
$tahun      = date("Y");

$sql5 = "SELECT kriteria FROM tb_kriteria_lokasi WHERE id_lokasi = '$id_lokasi'";
$result5 = $connect->query($sql5);

$criteria = array();
while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {     
  $kriteria = json_decode($row['kriteria'], true);
  for ($i=0; $i < count($kriteria) ; $i++) { 
    $criteria[$kriteria[$i]['id_kriteria']] = $kriteria[$i]['weight'];
  }
}

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
$data_bulan = $kriteria[1]['data_bulan'];
$kriteria2 = array_sum($data_bulan)/3;
?>

<!-- koding CSS -->
<style media="screen">
  .judul {
    padding: 4mm;
    text-align: center;
  }
  h1, h2, h3, h4, h5, h6 {
    margin: 0;
    padding: 0;
  }
  .admin {
    font-weight: bold;
  }
  .nama {
    text-decoration: underline;
  }
</style>

<!-- koding HTML dan PHP query -->
<div class="judul">
  <h2>Pemerintah Kabupaten Polewali Mandar</h2>
  <h2>Dinas Pertanian dan Pangan</h2>
  <p><em>JL. Muhammad Yamin No. 177, Madatte, Polewali, Kabupaten Polewali Mandar, Sulawesi Barat</em> </p>
  <hr>
</div>

<p align="center">Data Lokasi <br> <br>
  <?php echo $nm_lok['nama_lokasi']; ?>
</p>

<table border="1" align="center">
  <tr align="center">
    <th><?= $j_kriteria[0] ?></th>
    <th colspan="3"><?= $j_kriteria[1] ?></th>
    <th><?= $j_kriteria[2] ?></th>
    <th><?= $j_kriteria[3] ?></th>
    <th><?= $j_kriteria[4] ?></th>
  </tr>
  <tr align='center'>
    <td rowspan="3">
      <?php 
      if ($criteria[1] == 4) {
        echo "Latosol";
      }elseif ($criteria[1] == 3){
        echo "Organosol";
      }elseif ($criteria[1] == 2){
        echo "Podzolik";
      }elseif ($criteria[1] == 1){
        echo "Litosol";
      }

      ?>
    </td>
    <td colspan="3">
      <?php      
      if ($kriteria2 >= 300 && $kriteria2 <= 400) {
        echo 'Tinggi (300-400 mm/bulan)';
      } else if ($kriteria2 >= 200 && $kriteria2 <= 300) {
        echo 'Menengah (200-300 mm/bulan)';
      } else if ($kriteria2 >= 100 && $kriteria2 <= 200) {
        echo 'Rendah (100-200 mm/bulan)';
      } 
      ?>
    </td>
    <td rowspan="3">
      <?php 
      if ($criteria[3] == 2) {
        echo "Ada";
      }elseif ($criteria[3] == 1){
        echo "Tidak Ada";
      }
      ?>
    </td>
    <td rowspan="3">
      <?php 
      if ($criteria[4] == 4) {
        echo "Basa Sedang (7,5 - 8,5)";
      }elseif ($criteria[4] == 3){
        echo "Netral (7,0 - 7,5)";
      }elseif ($criteria[4] == 2){
        echo "Asam Sedang (4,0 - 6,9)";
      }elseif ($criteria[4] == 1){
        echo "Sangat Asam (< 4)";
      }
      ?>
    </td>
    <td rowspan="3">
      <?php 
      if ($criteria[5] == 2) {
        echo "Dataran Tinggi (500 - 1500 mdpl)";
      }elseif ($criteria[5] == 1){
        echo "Dataran Rendah (0 - 500 mdpl)";
      }
      ?>
    </td>
  </tr>
  <tr>
    <?php foreach ($data_bulan as $key => $value) { ?>
      <td><?= bulan($key) ?></td>      
    <?php } ?>
  </tr>
  <tr>
    <?php foreach ($data_bulan as $key => $value) { ?>
      <td><?= $value ?></td>      
    <?php } ?>
  </tr>
</table>

<p align="center">Ranking Tanaman Hasil Electre</p>

<table border="1" align="center">
  <tr>
    <th>Ranking</th>
    <th>Nama Tanaman</th>
    <th>Poin</th>
  </tr>
  <?php 
  $ranking1 = 1;
  $hasil_akhir1 = json_decode($hasil['hasil_electre'], true);
  foreach ($hasil_akhir1 as $key1 => $value1) {
    echo "<tr>";
    echo "<td>".$ranking1++."</td>";
    echo "<td>".$namatanaman[$key1]."</td>";
    echo "<td>".$value1."</td>";
    echo "</tr>";
  }
  ?>
</table>



<p align="center">Ranking Tanaman Hasil Topsis</p>

<table border="1" align="center">
  <tr>
    <th>Ranking</th>
    <th>Nama Tanaman</th>
    <th>Poin</th>
  </tr>
  <?php 
  $ranking2 = 1;
  $hasil_akhir2 = json_decode($hasil['hasil_topsis'], true);
  foreach ($hasil_akhir2 as $key2 => $value2) {
    echo "<tr>";
    echo "<td>".$ranking2++."</td>";
    echo "<td>".$namatanaman[$key2]."</td>";
    echo "<td>".$value2."</td>";
    echo "</tr>";
  }
  ?>
</table>

<?php
$electre = key($hasil_akhir1); 
$topsis = key($hasil_akhir2);
?>

<table align="center">
  <tr>
    <td align="justify" width="600">
      <p>Berdasarkan Hasil analisa diatas, untuk metode Electre, tanaman yang memiliki poin tertinggi adalah <?php echo "<b>{$alternatif[$electre][0]}</b>" ?>. Sedangkan untuk hasil metode Topsis, yang memiliki nilai tertinggi adalah tanaman <?php echo "<b>{$alternatif[$topsis][0]}</b>" ?>.</p>
    </td>
  </tr>
</table>

<br /><br />

<table >
  <tr>
    <td width="500"></td>
    <td align="center">
      <p>Makassar, <?php echo $tgl."-".$bulan2."-".$tahun ?></p>
      <p class="admin" >Menyetujui,<br>Kepala Dinas Pertanian dan Pangan <br>Kabupaten Polewali Mandar</p>
      <br>
      <br>
      <p class="nama">MUHAMMAD NASIR, SP.MP</p>
      
    </td>
  </tr>
</table>


<?php
$content = ob_get_clean();
include_once('vendor/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Cetak.pdf');
?>