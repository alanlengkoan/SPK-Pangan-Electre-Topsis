<?php 
include_once '../database/koneksi.php';
if (isset($_POST['ubah'])) {
    $id  = $_POST['id'];
    $lokasi  = $_POST['lokasi'];

    $query  = "UPDATE tb_lokasi SET nama_lokasi = '$lokasi' WHERE id_lokasi = '$id'";
    $result = $connect->query($query);
    if ($result) {
        header('location:'.'data_lokasi.php');
    } else {
        echo "<script>
        window.alert('Tidak Dapat Mengubah Data !');
        window.location=(href='data_lokasi.php')
        </script>";
    }
}

?>