<?php
// untuk koneksi
include_once '../database/koneksi.php';
$id_tanaman = $_GET['id_tanaman'];
$sql   = "DELETE FROM tb_alternatif WHERE id_alternative = '$id_tanaman'";
$query = $connect->query($sql);
if ($query) {
  header('location:'.'data_tanaman.php');
}
 ?>