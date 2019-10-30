<?php
include_once '../database/koneksi.php';
$id_tanaman = $_GET['id_tanaman'];
$sql   = "SELECT * FROM tb_alternatif WHERE id_alternative = '$id_tanaman'";
$query = $connect->query($sql);
$row = $query->fetch_array(MYSQLI_ASSOC);
?>

<form method="POST">
	<div class="col-sm-12">
		<div class="form-group form-float">
			<div class="form-line">
				<input type="text" class="form-control" name="id" value="<?php echo $row['id_alternative'] ?>">
			</div>
		</div>
		<div class="form-group form-float">
			<div class="form-line">
				<input type="text" class="form-control" name="nm_tanaman" value="<?php echo $row['name'] ?>">
			</div>
		</div>
	</div>
	<input type="submit" name="ubah" value="UBAH" class="btn btn-link waves-effect">
	<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
</form>