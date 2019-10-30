<!-- untuk koneksi -->
<?php include_once 'atribut/head.php'; ?>
<?php
$id_alternative = $_GET['id_alternatif'];
$id_criteria = $_GET['id_kriteria'];
$sql      = "SELECT * FROM tb_evaluasi WHERE id_alternative = '$id_alternative' AND id_criteria = '$id_criteria'";
$query    = $connect->query($sql);
$row = $query->fetch_array(MYSQLI_ASSOC);
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
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="card">
					<div class="header">
						<h2>
							Ubah Data Tanaman
						</h2>
					</div>
					<div class="body">
						<form method="POST">
							<label>Id Alternatif</label>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="idalternatif" value="<?php echo $id_alternative; ?>" required="required">
								</div>
							</div>
							<label>
								<?php 

								if ($id_criteria == 1) {
									echo "Jenis Tanah";
								} else if ($id_criteria == 2) {
									echo "Curah Hujan";
								} else if ($id_criteria == 3) {
									echo "Drainase";
								} else if ($id_criteria == 4) {
									echo "PH";
								} else if ($id_criteria == 5) {
									echo "Ketinggian Tempat";
								}

								?>					
							</label>
							<input type="hidden" name="kriteria" value="<?php echo $id_criteria ?>" readonly="readonly">
							<?php if ($id_criteria == 1) { ?>
								<div class="form-group form-float">
									<div class="form-line">
										<select class="form-control show-tick" name="value">
											<option><?php echo $row['value']; ?></option>
											<option value="4">Latosol</option>
											<option value="3">Organosol</option>
											<option value="2">Podzolik</option>
											<option value="1">Litosol</option>
										</select>
									</div>
								</div>
							<?php } else if ($id_criteria == 2) { ?>
								<div class="form-group form-float">
									<div class="form-line">
										<select class="form-control show-tick" name="value">
											<option><?php echo $row['value']; ?></option>
											<option value="3">Tinggi (300-400 mm/bulan)</option>
											<option value="2">Menengah (200-300 mm/bulan)</option>
											<option value="1">Rendah (100-200 mm/bulan)</option>
										</select>	
									</div>
								</div>
							<?php } else if ($id_criteria == 3) { ?>
								<div class="form-group form-float">
									<div class="form-line">
										<select class="form-control show-tick" name="value">
											<option><?php echo $row['value']; ?></option>
											<option value="2">Ada</option>
											<option value="1">Tidak Ada</option>
										</select>	
									</div>
								</div>
							<?php } else if ($id_criteria == 4) { ?>
								<div class="form-group form-float">
									<div class="form-line">
										<select class="form-control show-tick" name="value">
											<option><?php echo $row['value']; ?></option>
											<option value="4">Basa Sedang (7,5 - 8,5)</option>
											<option value="3">Netral (7,0 - 7,5)</option>
											<option value="2">Asam Sedang (4,0 - 6,9)</option>
											<option value="1">Sangat Asam (< 4)</option>
										</select>	
									</div>
								</div>
							<?php } else if ($id_criteria == 5) { ?>
								<div class="form-group form-float">
									<div class="form-line">
										<select class="form-control show-tick" name="value">
											<option><?php echo $row['value']; ?></option>
											<option value="2">Dataran Tinggi (500 - 1500 mdpl)</option>
											<option value="1">Dataran Rendah (0 - 500 mdpl)</option>
										</select>	
									</div>
								</div>
							<?php } ?>
							<a href="data_kriteria_tanaman.php" class="btn btn-link btn-danger waves-effect">Batal</a>
							<input type="submit" name="ubah" value="Ubah" class="btn btn-link btn-primary waves-effect">
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

	$idalternatif = $_POST['idalternatif'];
	$kriteria     = $_POST['kriteria'];
	$value        = $_POST['value'];

	$query  = "UPDATE tb_evaluasi SET value = '$value' WHERE id_alternative = '$idalternatif' AND id_criteria = '$kriteria'";
	$result = $connect->query($query);

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