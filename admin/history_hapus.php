<?php
// untuk koneksi
include_once '../database/koneksi.php';
$id_history = $_GET['id_history'];
$sql = "SELECT * FROM tb_history WHERE id_history = '$id_history' ";
$query = $connect->query($sql);
$data = $query->fetch_array(MYSQLI_ASSOC);

$id_lokasi = $data['lokasi'];

$connect->query("DELETE FROM tb_ranking WHERE id_lokasi = '$id_lokasi'");
$delete = $connect->query("DELETE FROM tb_history WHERE id_history = '$id_history'");

if ($delete) {
  header('location:'.'history.php');
}
 ?>