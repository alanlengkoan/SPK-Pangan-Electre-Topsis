<?php
// untuk koneksi
include_once '../database/koneksi.php';
$id_lokasi = $_GET['id_lokasi'];
$sql   = "DELETE FROM tb_lokasi WHERE id_lokasi = '$id_lokasi'";
$query = $connect->query($sql);
if ($query) {
  header('location:'.'data_lokasi.php');
}
 ?>