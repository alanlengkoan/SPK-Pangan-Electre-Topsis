<?php

$host = 'localhost';
$user = 'my_root';
$pass = 'my_pass';
$dbnm = 'spk_pangan_ele_top';

$connect = new mysqli($host, $user, $pass, $dbnm);

if ($connect->connect_error) {
   die('Maaf koneksi gagal: ' . $connect->connect_error);
}
