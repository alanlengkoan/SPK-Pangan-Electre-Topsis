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
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">ac_unit</i>
                    </div>
                    <div class="content">
                        <div class="text">TANAMAN</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                            <?php 
                            $sql = "SELECT * FROM tb_alternatif";
                            $query = mysqli_query($connect,$sql);
                            $jumlah = $query->num_rows;
                            echo $jumlah;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">location_on</i>
                    </div>
                    <div class="content">

                        <div class="text">LOKASI</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
                            <?php 
                            $sql = "SELECT * FROM tb_lokasi";
                            $query = mysqli_query($connect,$sql);
                            $jumlah = $query->num_rows;
                            echo $jumlah;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>SEPUTAR SISTEM PENDUKUNG KEPUTUSAN</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" align="justify">
                        <p>Sistem Pendukung Keputusan (SPK) atau Decision Support System (DSS) adalah sebuah sistem yang mampu memberikan kemampuan pemecahan masalah maupun kemampuan pengkomunikasian untuk masalah dengan kondisi semi terstruktur dan tak terstruktur. Sistem ini digunakan untuk membantu pengambilan keputusan dalam situasi semi terstruktur dan situasi yang tidak terstruktur, dimana tak seorangpun tahu secara pasti bagaimana keputusan seharusnya dibuat (Turban, 2001). Hal lainnya yang perlu dipahami adalah bahwa SPK bukan untuk menggantikan tugas manajer akan tetapi hanya sebagai bahan pertimbangan bagi manajer untuk menentukan keputusan akhir.</p>
                        <br>
                        <p>Sprague dan Watson mendefinisikan Sistem Pendukung Keputusan (SPK) sebagai sistem yang memiliki lima karakteristik utama yaitu (Sprague et.al, 1993):
                            <li>Sistem yang berbasis komputer. </li>
                            
                            <li>Dipergunakan untuk membantu para pengambil keputusan</li>
                            <li>Untuk memecahkan masalah-masalah rumit yang mustahil dilakukan dengan kalkulasi manual</li>
                            <li>Melalui cara simulasi yang interaktif</li>
                            <li>Dimana data dan model analisis sebaai komponen utama</li>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
        <div class="row clearfix">
            <!-- Visitors -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card" align="justify">
                    <div class="body bg-pink">
                        <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                        data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                        data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                        data-fill-Color="rgba(0, 188, 212, 0)">
                        METODE ELECTRE
                    </div>
                    <br>
                    <br>
                    <p>Menurut Janko dan Bemoider (2005:11), ELECTRE merupakan salah satu metode pengambilan keputusan multikriteria berdasarkan pada konsep outranking dengan menggunakan perbandingan berpasangan dari altematif-alternatif berdasarkan setiap kriteria yang sesuai. Metode ELECTRE digunakan pada kondisi dimana alternatif yang kurang sesuai dengan kriteria dieliminasi dan alternatif yang sesuai dapat dihasilkan. Dengan kata lain, ELECTRE digunakan untuk kasus-kasus dengan banyak alternatif namun hanya sedikit kriteria yang dilibatkan.</p>
                    <br>
                    <p>Langkah-langkah yang dilakukan dalam penyelesaian masalah menggunakan metode ELECTRE adalah sebagai berikut:
                        <ul style="padding: 15px">
                            <li>Normalisasi Matriks Keputusan</li>
                            <li>Pembobotan Pada Matriks Yang Telah Dinormalisasi</li>
                            <li>Menentukan himpunan concordance dan discordance index</li>
                            <li>Menghitung matriks concordance dan discordance</li>
                            <li>Menentukan matriks dominan concordance dan discordance</li>
                            <li>Menentukan aggregate dominance matrix</li>
                            <li>Eliminasi alternatif yang less favourable</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <!-- #END# Visitors -->
        <!-- Latest Social Trends -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card" align="justify">
                <div class="body bg-cyan">
                    <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                    data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                    data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                    data-fill-Color="rgba(0, 188, 212, 0)">
                    METODE TOPSIS
                </div>
                <br>
                <br>
                <p>Metode TOPSIS adalah salah satu metode yang digunakan untuk menyelesaikan masalah Multi Attribute Decision Making (MADM). Metode TOPSIS didasarkan pada konsep dimana alternatif terpilih yang terbaik tidak hanya memiliki jarak terpendek dari solusi ideal positif, namun juga memiliki jarak terpanjang dari solusi ideal negatif. Metode TOPSIS memiliki beberapa kelebihan, diantaranya konsepnya yang sederhana dan mudah dipahami, komputasinya efisien, dan memiliki kemampuan untuk mengukur kinerja relatif dari alternatif-alternatif keputusan dalam bentuk matematis yang sederhana. (Akhmad Fadjar Siddiq, 2012).</p>
                <br>
                <p>Secara umum, prosedur TOPSIS mengikuti langkah-langkah sebagai berikut :
                    <ul style="padding: 15px">
                        <li>Membuat matriks keputusan yang ternormalisasi</li>
                        <li>Membuat matriks keputusan yang ternormalisasi terbobot.</li>
                        <li>Menentukan matriks solusi ideal positif & matriks solusi ideal negatif.</li>
                        <li>Menentukan jarak antara nilai setiap alternatif dengan matriks solusi ideal positif & matriks solusi ideal negatif.</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
    <!-- #END# Latest Social Trends -->
    <!-- Answered Tickets -->
    <!-- #END# Answered Tickets -->
</div>

<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="header">
                <h2>DAFTAR LOKASI PENANAMAN</h2>
                <ul class="header-dropdown m-r--5">
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                   <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $sql = "SELECT * FROM tb_lokasi";
                        $query = $connect->query($sql);

                        while ($row = $query->fetch_array()) {
                            echo "<tr>";
                            echo "<td>".$no++."</td>";
                            echo "<td>".$row['nama_lokasi']."</td>";
                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# Task Info -->
<!-- Browser Usage -->
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="header">
            <h2>DAFTAR TANAMAN</h2>
        </div>
        <div class="body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tanaman</th>
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
                        echo "</tr>";
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- #END# Browser Usage -->
</div>
</div>
</section>

<?php include_once 'atribut/foot.php'; ?>