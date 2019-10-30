<?php
include_once '../database/koneksi.php';
$id_lokasi = $_GET['id_lokasi'];
$sql = "SELECT tb_kriteria_lokasi.*, tb_lokasi.nama_lokasi FROM tb_kriteria_lokasi, tb_lokasi WHERE tb_kriteria_lokasi.id_lokasi = '$id_lokasi' AND tb_lokasi.id_lokasi = '$id_lokasi'";
$query = $connect->query($sql);
$row = $query->fetch_array(MYSQLI_ASSOC);
$kriteria = json_decode($row['kriteria'], true);
?>

<form method="POST">
	<div class="col-sm-12">
		<div class="form-group form-float">
			<div class="form-line">
				<input type="text" class="form-control" name="id_lokasi" readonly="readonly" value="<?php echo $row['id_lokasi'] ?>">
			</div>
		</div>
		<label>Lokasi</label>
		<div class="form-group form-float">
			<div class="form-line">
				<select name="inp_namalokasi" class="form-control show-tick">
					<option value="<?php echo $row['id_lokasi'] ?>"><?php echo $row['nama_lokasi']; ?></option>
					<?php
					$sql      = "SELECT * FROM tb_lokasi";
					$lokasi = $connect->query($sql);

					while ($row = $lokasi->fetch_array(MYSQLI_ASSOC)) {
						?>
						<option value="<?php echo $row['id_lokasi'] ?>"><?php echo $row['nama_lokasi']; ?></option>
					<?php }	?>
				</select>
			</div>
		</div>
		<label>Jenis Tanah</label>
		<div class="form-group form-float">
			<div class="form-line">
				<input type="hidden" name="id_kriteria1" value="1" readonly="readonly">
				<select name="kriteria1" class="form-control show-tick">
					<option><?php echo $kriteria[0]['weight']; ?></option>
					<option value="4">Latosol</option>
					<option value="3">Organosol</option>
					<option value="2">Podzolik</option>
					<option value="1">Litosol</option>
				</select>
			</div>
		</div>

		<input type="hidden" name="id_kriteria2" value="2" readonly="readonly">
		<input type="hidden" name="kriteria2" readonly="readonly" value="Curah Hujan">

		<label>Drainase</label>
		<div class="form-group form-float">
			<div class="form-line">
				<input type="hidden" name="id_kriteria3" value="3" readonly="readonly">
				<select name="kriteria3" class="form-control show-tick">
					<option><?php echo $kriteria[2]['weight'] ?></option>
					<option value="2">Ada</option>
					<option value="1">Tidak Ada</option>
				</select>
			</div>
		</div>
		<label>Ph</label>
		<div class="form-group form-float">
			<div class="form-line">
				<input type="hidden" name="id_kriteria4" value="4" readonly="readonly">
				<select name="kriteria4" class="form-control show-tick">
					<option><?php echo $kriteria[3]['weight'] ?></option>
					<option value="4">Basa Sedang (7,5 - 8,5)</option>
					<option value="3">Netral (7,0 - 7,5)</option>
					<option value="2">Asam Sedang (4,0 - 6,9)</option>
					<option value="1">Sangat Asam (< 4)</option>
				</select>
			</div>
		</div>
		<label>Ketinggian Tempat</label>
		<div class="form-group form-float">
			<div class="form-line">
				<input type="hidden" name="id_kriteria5" value="5" readonly="readonly">
				<select name="kriteria5" class="form-control show-tick">
					<option><?php echo $kriteria[4]['weight'] ?></option>
					<option value="2">Dataran Tinggi (500 - 1500 mdpl)</option>
					<option value="1">Dataran Rendah (0 - 500 mdpl)</option>
				</select>
			</div>
		</div>
	</div>
	<input type="submit" name="ubah" value="UBAH" class="btn btn-link waves-effect">
	<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
</form>