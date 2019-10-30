<?php include_once 'database/koneksi.php'; ?>

<?php 
error_reporting(0);
if (isset($_POST['proses'])) {
  // mengambil hasil inputan
  $nma_pengunjung = $_POST['inp_nama_pengujung'];
  $id_lokasi      = $_POST['inp_lokasi'];
  $id_bulan       = $_POST['inp_bulan'];
  $alamat         = $_POST['inp_alamat'];

  // insert ke dalam tabel history
  $connect->query("INSERT INTO tb_history (nama, alamat, lokasi, bulan) VALUES ('$nma_pengunjung', '$alamat', '$id_lokasi', '$id_bulan')");

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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistem Pendukung Keputusan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="assets/fonts/icomoon/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="assets/css/aos.css">
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar py-4 js-sticky-header site-navbar-target" style="background-color: #000;" role="banner">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25" style="color: #fff; padding-top: 10px">SPK PANGAN</div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="konsul.php" class="nav-link">Konsul</a></li>
                <li><a href="history.php" class="nav-link">History</a></li>
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25"></div>
        </div>
      </div>
    </header>

    <div class="site-section">
      <div class="container">
        <div class="row mt-5 justify-content-center">
          <div class="col-lg-12">
            <h4 class="text-center" style="color: #000">Silahkan isi form dibawah</h4>
            
            <div class="card">
              <div class="card-header">
                Hasil Perhitungan Metode
              </div>
              <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Proses Metode Electre</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Proses Metode Topsis</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                   <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                        <div class="card-header">
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

                              $sql="SELECT COUNT(*) FROM tb_kriteria";
                              $result=$connect->query($sql);
                              $row=$result->fetch_row();
                              $n=$row[0];
                              $sql="SELECT * FROM tb_evaluasi
                              ORDER BY id_alternative, id_criteria";
                              $result=$connect->query($sql);
                              $X=array();
                              $alternative='';
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

                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                        <div class="card-header">
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
                              $x_rata=array();
                              foreach($X as $i=>$x){
                                foreach($x as $j=>$value){
                                  $x_rata[$j]=(isset($x_rata[$j])?$x_rata[$j]:0)+pow($value,2);
                                }
                              }
                              for($j=1;$j<=$n;$j++){
                                $x_rata[$j]=sqrt($x_rata[$j]);
                              }
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

                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                        <div class="card-header">
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

                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                        <div class="card-header">
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

                              $V=$w=array();
                              foreach($criteria as $j=>$weight)
                                $w[$j]=$weight;
                              $alternative='';
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

                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                      <div class="card-header">
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

            <div class="row">
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

          <div class="row">
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

          <div class="row">
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

          <div class="row">
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

        <div class="row">
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

        <div class="row ">
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

      <div class="row ">
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

  <div class="row ">
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

<div class="row ">
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
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

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

<div class="row ">
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

<div class="row ">
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

<div class="row ">
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

<div class="row ">
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

<div class="row ">
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

<div class="row ">
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

  <div class="row ">
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

    <div class="row ">
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


<?php 

if (isset($_POST['proses'])) {
  $hasil_akhir1 = json_encode($hasil1);
  $hasil_akhir2 = json_encode($hasil2);

  $sql    = "SELECT * FROM tb_ranking WHERE id_lokasi = '$id_lokasi' ";
  $tambah = mysqli_query($connect, $sql);

  if ($row = mysqli_fetch_row($tambah)) {

    $sql   = "DELETE FROM tb_ranking WHERE id_lokasi = '$id_lokasi'";
    $query = mysqli_query($connect, $sql);
    $sql2 = "INSERT INTO tb_ranking (id_lokasi, hasil_electre, hasil_topsis) VALUES ('$id_lokasi', '$hasil_akhir1', '$hasil_akhir2')";
    $query = mysqli_query($connect, $sql2);

  } else {

    $sql = "INSERT INTO tb_ranking (id_lokasi, hasil_electre, hasil_topsis) VALUES ('$id_lokasi', '$hasil_akhir1', '$hasil_akhir2')";
    $query = $connect->query($sql);
  }
}
?>

</div> <!-- .site-wrap -->

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.stellar.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/jquery.fancybox.min.js"></script>
<script src="assets/js/jquery.sticky.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>