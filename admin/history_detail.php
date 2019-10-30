<?php
include_once 'atribut/head.php';
error_reporting(0);

$id_history = $_GET['id_history'];
$get_data = "SELECT tb_history.*, tb_lokasi.nama_lokasi FROM tb_history INNER JOIN tb_lokasi ON tb_history.lokasi = tb_lokasi.id_lokasi WHERE id_history = '$id_history' ";
$q_data   = $connect->query($get_data);
$s_data   = $q_data->fetch_array(MYSQLI_ASSOC);

$nma_pengunjung = $s_data['nama'];
$id_lokasi      = $s_data['lokasi'];
$id_bulan       = $s_data['bulan'];
$alamat         = $s_data['alamat'];

$sql2 = "SELECT * FROM tb_alternatif";
$result2 = $connect->query($sql2);

$sql3 = "SELECT id_criteria, criteria FROM tb_kriteria";
$result3 = $connect->query($sql3);

$tanaman = array();
$alternatif = array();

while($row = $result2->fetch_row()){
  $tanaman[$row[0]] = $row[0];
  $alternatif[$row[0]]=array($row[1]);
}

$bulan1   = date($id_bulan);
$bulan2   = date($id_bulan) + 1;
$bulan3   = date($id_bulan) + 2;

$sql      = "SELECT * FROM tb_kriteria WHERE id_criteria = '2'";
$query    = $connect->query($sql);
$row      = $query->fetch_array(MYSQLI_ASSOC);
$kriteria = json_decode($row['bulan'], true);

for ($i = 0; $i < count($kriteria); $i++) {
  if ($kriteria[$i]['id_bulan'] == $bulan1) {
    $data_bulan = array(
      $bulan1 => $kriteria[$i]['value'],
      $bulan2 => $kriteria[$i+1]['value'],
      $bulan3 => $kriteria[$i+2]['value']
    );
  }
}

$hitung = array_sum($data_bulan) / 3;

if ($hitung >= 300 && $hitung <= 400) {
  $hasil = 3;
  $ket = "Tinggi (300-400 mm/bulan)";
} else if ($hitung >= 200 && $hitung <= 300) {
  $hasil = 2;
  $ket = "Menengah (200-300 mm/bulan)";
} else if ($hitung >= 100 && $hitung <= 200) {
  $hasil = 1;
  $ket = "Rendah (100-200 mm/bulan)";
}

$query4   = $connect->query("SELECT * FROM tb_kriteria_lokasi WHERE id_lokasi = '$id_lokasi'");
$row      = $query4->fetch_array(MYSQLI_ASSOC);
$kriteria = json_decode($row['kriteria'], true);

$array_kriteria = array(
  ['id_kriteria' => $kriteria[0]['id_kriteria'], 'kriteria' => $kriteria[0]['kriteria'], 'weight' => $kriteria[0]['weight']],
  ['id_kriteria' => $kriteria[1]['id_kriteria'], 'kriteria' => $kriteria[1]['kriteria'], 'weight' => $hasil, 'data_bulan' => $data_bulan, 'ket' => $ket],
  ['id_kriteria' => $kriteria[2]['id_kriteria'], 'kriteria' => $kriteria[2]['kriteria'], 'weight' => $kriteria[2]['weight']],
  ['id_kriteria' => $kriteria[3]['id_kriteria'], 'kriteria' => $kriteria[3]['kriteria'], 'weight' => $kriteria[3]['weight']],
  ['id_kriteria' => $kriteria[4]['id_kriteria'], 'kriteria' => $kriteria[4]['kriteria'], 'weight' => $kriteria[4]['weight']],
);
$data_kriteria = json_encode($array_kriteria);
$connect->query("UPDATE tb_kriteria_lokasi SET kriteria = '$data_kriteria' WHERE id_lokasi = '$id_lokasi'");
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
              Hasil Metode
            </h2>
          </div>
          <div class="body">
           <!-- Nav tabs -->
           <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#home" data-toggle="tab">Proses Electre</a></li>
            <li role="presentation"><a href="#profile" data-toggle="tab">Proses Topsis</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="header">
                      Membentuk Perbandingan Berpasangan (X)
                    </div>
                    <div class="body table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Alternatif</th>
                            <?php 
                            foreach ($result3 as $key) {
                              echo "<th>".$key['criteria']."</th>";
                            }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

    //-- query untuk mengambil data jumlah kriteria 'n'
                          $sql="SELECT COUNT(*) FROM tb_kriteria";
                          $result=$connect->query($sql);
                          $row=$result->fetch_row();
    //--- inisialisasi jumlah kriteria 'n'
                          $n=$row[0];
    //-- query untuk mengambil data Perbandingan Berpasangan X
                          $sql="SELECT * FROM tb_evaluasi
                          ORDER BY id_alternative, id_criteria";
                          $result=$connect->query($sql);
                          $X=array();
                          $alternative='';
    //--- inisialisasi jumlah alternative 'm'
                          $m=0;

                          while($row=$result->fetch_row()){
                            if($row[0]!=$alternative){
                              $X[$row[0]]=array();
                              $alternative=$row[0];
                              ++$m;
                            }
                            $X[$row[0]][$row[1]]=$row[2];
                          }

                          foreach ($X as $key => $value) {
                            echo "<tr>";
                            echo "<td>".$alternatif[$key][0]."</td>";
                            for ($i = 1; $i <= count($value); $i++) {
                              echo "<td>".$value[$i]."</td>";
                            }
                            echo "</tr>";
                          }

                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="header">
                      Perbandingan Berpasangan Ternormalisasi (R)
                    </div>
                    <div class="body table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th></th>
                            <?php 

                            foreach ($result3 as $key) {
                              echo "<th>".$key['criteria']."</th>";
                            }

                            ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

    //-- menentukan nilai rata-rata kuadrat per-kriteria
                          $x_rata=array();
                          foreach($X as $i=>$x){
                            foreach($x as $j=>$value){
                              $x_rata[$j]=(isset($x_rata[$j])?$x_rata[$j]:0)+pow($value,2);
                            }
                          }
                          for($j=1;$j<=$n;$j++){
                            $x_rata[$j]=sqrt($x_rata[$j]);
                          }
    //-- menormalisasi matriks X menjadi matriks R
                          $R=array();
                          $alternative='';
                          foreach($X as $i=>$x){
                            if($alternative!=$i){
                              $alternative=$i;
                              $R[$i]=array();
                            }
                            foreach($x as $j=>$value){
                              $R[$i][$j]=$value/$x_rata[$j];
                            }
                          }

                          foreach ($R as $key => $value) {
                            echo "<tr>";                        
                            echo "<td>".$tanaman[$key]."</td>";
                            for ($i = 1; $i <= count($value); $i++) {
                              echo "<td>".$value[$i]."</td>";
                            }
                            echo "</tr>";
                          }

                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="header">
                      Menentukan Bobot tiap-tiap Kriteria (W)
                    </div>
                    <div class="body table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <?php 

                            foreach ($result3 as $key) {
                              echo "<th>".$key['criteria']."</th>";
                            }

                            ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                            // query untuk mengambil data nilai bobot criteria
                          $sql="SELECT kriteria FROM tb_kriteria_lokasi WHERE id_lokasi = '$id_lokasi'";
                          $result = $connect->query($sql);

                          $criteria = array();
                          while ($row = $result->fetch_array()) {

                            $kriteria = json_decode($row['kriteria'], true);      
                            for ($i=0; $i < count($kriteria) ; $i++) { 
                              $criteria[$kriteria[$i]['id_kriteria']] = $kriteria[$i]['weight'];
                            }  

                          }

                          echo "<tr>";
                          for ($i = 1; $i <= count($criteria); $i++) {
                            echo "<td>".$criteria[$i]."</td>";
                          }
                          echo "</tr>";



                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="header">
                      Membentuk Matrik Preferensi (V)
                    </div>
                    <div class="body table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th></th>
                            <?php 

                            foreach ($result3 as $key) {
                              echo "<th>".$key['criteria']."</th>";
                            }

                            ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

    //-- inisialisasi matrik preferensi V dan himpunan bobot kriteria w
                          $V=$w=array();
    //-- memasukkan data bobot ke dalam $w
                          foreach($criteria as $j=>$weight)
                            $w[$j]=$weight;
                          $alternative='';
    //-- menghitung nilai Preferensi V
                          foreach($R as $i=>$r){
                            if($alternative!=$i){
                              $alternative=$i;
                              $V[$i]=array();
                            }
                            foreach($r as $j=>$value){
                              $V[$i][$j]=$w[$j]*$value;
                            }
                          }

                          foreach ($V as $key => $value) {
                           echo "<tr>";                        
                           echo "<td>".$tanaman[$key]."</td>";
                           for ($i = 1; $i <= count($value); $i++) {
                            echo "<td>".$value[$i]."</td>";
                          }
                          echo "</tr>";
                        }

                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="header">
                    Menentukan Concordance Index (Ckl)
                  </div>
                  <div class="body table-responsive">
                    <table class="table table-bordered">
                     <thead>
                      <tr>
                        <th></th>
                        <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['name']."</th>";
                        }
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $c=array();
                      $c_index='';
                      for($k=1;$k<=$m;$k++){
                        if($c_index!=$k){
                          $c_index=$k;
                          $c[$k]=array();
                        }
                        for($l=1;$l<=$m;$l++){
                          if($k!=$l){
                            for($j=1;$j<=$n;$j++){
                              if(!isset($c[$k][$l]))$c[$k][$l]=array();
                              if($V[$k][$j]>=$V[$l][$j]){
                                array_push($c[$k][$l],$j);
                              }
                            }
                          } else if (isset($c[$k][$l]) == NULL) {
                            $c[$k][$l]=$c[$k][$l] = "-";
                          }
                        }
                      }

                      foreach ($c as $key => $value) {
                       echo "<tr>";                        
                       echo "<td>".$tanaman[$key]."</td>";
                       for ($i = 1; $i <= count($c); $i++) {
                        echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                Menentukan Discordance Index (Dkl)
              </div>
              <div class="body table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <?php 
                      foreach ($result2 as $key => $value) {
                        echo "<th>".$value['name']."</th>";
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $d=array();
                    $d_index='';
                    for($k=1;$k<=$m;$k++){
                      if($d_index!=$k){
                        $d_index=$k;
                        $d[$k]=array();
                      }
                      for($l=1;$l<=$m;$l++){
                        if($k!=$l){
                          for($j=1;$j<=$n;$j++){
                            if(!isset($d[$k][$l]))$d[$k][$l]=array();
                            if($V[$k][$j]<$V[$l][$j]){
                              array_push($d[$k][$l],$j);
                            }
                          }
                        } else if (isset($d[$k][$l]) == NULL) {
                          $d[$k][$l]=$d[$k][$l] = "-";
                        }
                      }
                    }

                    foreach ($d as $key => $value) {
                     echo "<tr>";                        
                     echo "<td>".$tanaman[$key]."</td>";
                     for ($i = 1; $i <= count($c); $i++) {
                      echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                    }
                    echo "</tr>";
                  }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              Membentuk Matriks Concordance (C)
            </div>
            <div class="body table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <?php 
                    foreach ($result2 as $key => $value) {
                      echo "<th>".$value['name']."</th>";
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $C=array();
                  $c_index='';
                  for($k=1;$k<=$m;$k++){
                    if($c_index!=$k){
                      $c_index=$k;
                      $C[$k]=array();
                    }
                    for($l=1;$l<=$m;$l++){
                      if($k!=$l && count($c[$k][$l])){
                        $f=0;
                        foreach($c[$k][$l] as $j){
                          $C[$k][$l]=(isset($C[$k][$l])?$C[$k][$l]:0)+$w[$j];
                        }
                      } else if (isset($C[$k][$l]) == NULL) {
                        $C[$k][$l]=$C[$k][$l] = "-";
                      }
                    }
                  }

                  foreach ($C as $key => $value) {
                    echo "<tr>";
                    echo "<tr>";                        
                    echo "<td>".$tanaman[$key]."</td>";
                    for ($i = 1; $i <= count($c); $i++) {
                      echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                    }
                    echo "</tr>";
                  }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              Threshold c
            </div>
            <div class="body table-responsive">
              <?php

              $sigma_c=0;
              foreach($C as $k=>$cl){
                foreach($cl as $l=>$value){
                  $sigma_c+=$value;
                }
              }
              $threshold_c=$sigma_c/($m*($m-1));
              echo $threshold_c;

              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              Membentuk Matriks Discordance (D)
            </div>
            <div class="body table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <?php 
                    foreach ($result2 as $key => $value) {
                      echo "<th>".$value['name']."</th>";
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $D=array();
                  $d_index='';
                  for($k=1;$k<=$m;$k++){
                    if($d_index!=$k){
                      $d_index=$k;
                      $D[$k]=array();
                    }
                    for($l=1;$l<=$m;$l++){
                      if($k!=$l){
                        $max_d=0;
                        $max_j=0;
                        if(count($d[$k][$l])){
                          $mx=array();
                          foreach($d[$k][$l] as $j){
                            if($max_d < abs($V[$k][$j]-$V[$l][$j]))
                              $max_d=abs($V[$k][$j]-$V[$l][$j]);
                          }
                        }
                        $mx=array();
                        for($j=1;$j<=$n;$j++){
                          if($max_j < abs($V[$k][$j]-$V[$l][$j]))
                            $max_j=abs($V[$k][$j]-$V[$l][$j]);
                        }
                        $D[$k][$l]= $max_d == 0 ? 0 : $max_d/$max_j;
                      } else if (isset($D[$k][$l]) == NULL) {
                        $D[$k][$l]=$D[$k][$l] = "-";
                      }
                    }
                  }

                  foreach ($D as $key => $value) {
                   echo "<tr>";                        
                   echo "<td>".$tanaman[$key]."</td>";
                   for ($i = 1; $i <= count($c); $i++) {
                    echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                  }
                  echo "</tr>";
                }

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            Threshold d
          </div>
          <div class="body table-responsive">
            <?php

            $sigma_d=0;
            foreach($D as $k=>$dl){
              foreach($dl as $l=>$value){
                $sigma_d+=$value;
              }
            }
            $threshold_d=$sigma_d/($m*($m-1));
            echo $threshold_d;

            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            Membentuk Matrik Concordance Dominan(F)
          </div>
          <div class="body table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                  foreach ($result2 as $key => $value) {
                    echo "<th>".$value['name']."</th>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php

                $F=array();
                foreach($C as $k=>$cl){
                  $F[$k]=array();
                  foreach($cl as $l=>$value){
                    $F[$k][$l]=($value >= $threshold_c?1:0);
                  }
                }

                foreach ($F as $key => $value) {
                 echo "<tr>";                        
                 echo "<td>".$tanaman[$key]."</td>";
                 for ($i = 1; $i <= count($c); $i++) {
                  echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                }
                echo "</tr>";
              }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          Membentuk Matrik Discordance Dominan(G)
        </div>
        <div class="body table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th></th>
              <?php 
              foreach ($result2 as $key => $value) {
                echo "<th>".$value['name']."</th>";
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php

            $G=array();
            foreach($D as $k=>$dl){
              $G[$k]=array();
              foreach($dl as $l=>$value){
                $G[$k][$l]=($value >= $threshold_d?1:0);
              }
            }

            foreach ($G as $key => $value) {
             echo "<tr>";                        
             echo "<td>".$tanaman[$key]."</td>";
             for ($i = 1; $i <= count($c); $i++) {
              echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
            }
            echo "</tr>";
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Membentuk Matrik Agregasi Dominan(E)
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
         <thead>
          <tr>
            <th></th>
            <?php 
            foreach ($result2 as $key => $value) {
              echo "<th>".$value['name']."</th>";
            }
            ?>
            <th>Poin</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $hasil1 = array();

          $E=array();
          foreach($F as $k=>$sl){
            $E[$k]=array();
            foreach($sl as $l=>$value){
              $E[$k][$l]=$F[$k][$l]*$G[$k][$l];
            }
          }

          foreach ($E as $key => $value) {
            $hasil1[$tanaman[$key]] = array_sum($value);

            echo "<tr>";                        
            echo "<td>".$tanaman[$key]."</td>";
            for ($i = 1; $i <= count($c); $i++) {
              echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
            }
            echo "<td>".array_sum($value)."</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Ranking Tanaman
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
         <thead>
          <tr>
            <th>Ranking</th>
            <th>Nama Tanaman</th>
            <th>Poin</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          arsort($hasil1);
          $ranking = 1;
          foreach ($hasil1 as $key => $value) {
            echo "<tr>";
            echo "<td>".$ranking++."</td>";
            echo "<td>".$alternatif[$key][0]."</td>";
            echo "<td>".$value."</td>";
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
<div role="tabpanel" class="tab-pane fade" id="profile">

  <?php 
  $sql  = "SELECT a.value, b.name, c.criteria FROM tb_evaluasi AS a JOIN tb_alternatif AS b USING(id_alternative) JOIN tb_kriteria AS c USING(id_criteria)";
  $tampil = $connect->query($sql);

// sql untuk mengmabil nilai kriteria lokasi
  $sql2 = "SELECT kriteria FROM tb_kriteria_lokasi WHERE id_lokasi = '$id_lokasi'";
  $result = $connect->query($sql2);

  $data          = array();
  $kriterias     = array();
  $bobot         = array();
  $nilai_kuadrat = array();

  while ($row = $result->fetch_array()) {

    $kriteria = json_decode($row['kriteria'], true);      
    for ($i=0; $i < count($kriteria) ; $i++) { 
      $bobot[$kriteria[$i]['kriteria']] = $kriteria[$i]['weight'];
    }  

  }

  if ($tampil) {
    while($row = $tampil->fetch_object()){

      if(!isset($data[$row->name])){
        $data[$row->name]=array();
      }

      if(!isset($data[$row->name][$row->criteria])){
        $data[$row->name][$row->criteria]=array();
      }

      if(!isset($nilai_kuadrat[$row->criteria])){
        $nilai_kuadrat[$row->criteria]=0;
      }

    // $bobot[$row->criteria]=$row->weight;
      $data[$row->name][$row->criteria]=$row->value;
      $nilai_kuadrat[$row->criteria]+=pow($row->value,2);
      $kriterias[]=$row->criteria;
    }
  }

  $kriteria     =array_unique($kriterias);
  $jml_kriteria =count($kriteria);
  ?>

  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          Evaluation Matrix (x<sub>ij</sub>)
        </div>
        <div class="body table-responsive">
          <table class="table table-bordered">
           <thead>
            <tr>
              <th rowspan='3'>No</th>
              <th rowspan='3'>Alternatif</th>
              <th rowspan='3'>Nama</th>
              <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
            </tr>
            <tr>
              <?php
              foreach($kriteria as $k)
                echo "<th>$k</th>\n";
              ?>
            </tr>
            <tr>
              <?php
              for($n=1;$n<=$jml_kriteria;$n++)
                echo "<th>K$n</th>";
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
            foreach($data as $nama=>$krit){
              echo "<tr>
              <td>".(++$i)."</td>
              <th>A$i</th>
              <td>$nama</td>";
              foreach($kriteria as $k){
                echo "<td align='center'>$krit[$k]</td>";
              }
              echo "</tr>\n";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Rating Kinerja Ternormalisasi (r<sub>ij</sub>)
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
         <thead>
          <tr>
            <th rowspan='3'>No</th>
            <th rowspan='3'>Alternatif</th>
            <th rowspan='3'>Nama</th>
            <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
          </tr>
          <tr>
            <?php
            foreach($kriteria as $k)
              echo "<th>$k</th>\n";
            ?>
          </tr>
          <tr>
            <?php
            for($n=1;$n<=$jml_kriteria;$n++)
              echo "<th>K$n</th>";
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          foreach($data as $nama=>$krit){
            echo "<tr>
            <td>".(++$i)."</td>
            <th>A{$i}</th>
            <td>{$nama}</td>";
            foreach($kriteria as $k){
              echo "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)."</td>";
            }
            echo
            "</tr>\n";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Rating Bobot Ternormalisasi(y<sub>ij</sub>)
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
         <thead>
          <tr>
            <th rowspan='3'>No</th>
            <th rowspan='3'>Alternatif</th>
            <th rowspan='3'>Nama</th>
            <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
          </tr>
          <tr>
            <?php
            foreach($kriteria as $k)
              echo "<th>$k</th>\n";
            ?>
          </tr>
          <tr>
            <?php
            for($n=1;$n<=$jml_kriteria;$n++)
              echo "<th>K$n</th>";
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          $y=array();
          foreach($data as $nama => $krit){
            echo "<tr>
            <td>".(++$i)."</td>
            <th>A{$i}</th>
            <td>{$nama}</td>";
            foreach($kriteria as $k){
              $y[$k][$i-1] = round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) * $bobot[$k];
              echo "<td align='center'>".$y[$k][$i-1]."</td>";
            }
            echo
            "</tr>\n";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Solusi Ideal positif (A<sup>+</sup>)
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
         <thead>
          <tr>
            <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
          </tr>
          <tr>
            <?php
            foreach($kriteria as $k)
              echo "<th>$k</th>\n";
            ?>
          </tr>
          <tr>
            <?php
            for($n=1;$n<=$jml_kriteria;$n++)
              echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
            ?>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $yplus=array();
            foreach($kriteria as $k){
              $yplus[$k]=([$k]?max($y[$k]):min($y[$k]));
              echo "<th>$yplus[$k]</th>";
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Solusi Ideal negatif (A<sup>-</sup>)
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
            </tr>
            <tr>
              <?php
              foreach($kriteria as $k)
                echo "<th>{$k}</th>\n";
              ?>
            </tr>
            <tr>
              <?php
              for($n=1;$n<=$jml_kriteria;$n++)
                echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
              ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $ymin=array();
              foreach($kriteria as $k){
                $ymin[$k]=[$k]?min($y[$k]):max($y[$k]);
                echo "<th>{$ymin[$k]}</th>";
              }

              ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        Jarak positif (D<sub>i</sub><sup>+</sup>)
      </div>
      <div class="body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Alternatif</th>
              <th>Nama</th>
              <th>D<suo>+</sup></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=0;
              $dplus=array();
              $dplus_h = [];
              foreach($data as $nama=>$krit){
                echo "<tr>
                <td>".(++$i)."</td>
                <th>A{$i}</th>
                <td>{$nama}</td>";
                foreach($kriteria as $k){
                  if(!isset($dplus[$i-1])) $dplus[$i-1]=0;
                  $dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
                }
                echo "<td>".round(sqrt($dplus[$i-1]),6)."</td>
                </tr>\n";
                $dplus_h[] = round(sqrt($dplus[$i-1]),6);
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          Jarak negatif (D<sub>i</sub><sup>-</sup>)
        </div>
        <div class="body table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Nama</th>
                <th>D<suo>-</sup></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=0;
                $dmin=array();
                $dmin_h = [];
                foreach($data as $nama=>$krit){
                  echo "<tr>
                  <td>".(++$i)."</td>
                  <th>A{$i}</th>
                  <td>{$nama}</td>";
                  foreach($kriteria as $k){
                    if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
                    $dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
                  }
                  echo "<td>".round(sqrt($dmin[$i-1]),6)."</td>
                  </tr>\n";
                  $dmin_h[] = round(sqrt($dmin[$i-1]),6);
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            Nilai Preferensi(V<sub>i</sub>)
          </div>
          <div class="body table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Alternatif</th>
                  <th>Nama</th>
                  <th>V<sub>i</sub></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $hasil2 = array();
                $i=0;
                $V=array();
                foreach($data as $nama=>$krit){
                  echo "<tr>
                  <td>".(++$i)."</td>
                  <th>A{$i}</th>
                  <td>{$nama}</td>";
                  foreach($kriteria as $k){
                    $hasil2[$tanaman[$i]] = $V[$i-1] = $dmin_h[$i-1]/($dmin_h[$i-1]+$dplus_h[$i-1]);
                    $V[$i-1] = $dmin_h[$i-1]/($dmin_h[$i-1]+$dplus_h[$i-1]);
                  }
                  echo "<td>{$V[$i-1]}</td></tr>\n";
                }

                arsort($hasil2);
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
</div>
</div>

</section>

<?php include_once 'atribut/foot.php'; ?>