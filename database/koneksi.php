<?php

$host = 'localhost'; 
$user = 'root';
$pass = '0sampai1';
$dbnm = 'spk_pangan';

$connect = new mysqli($host, $user, $pass, $dbnm);

if ($connect->connect_error) {
   die('Maaf koneksi gagal: '. $connect->connect_error);
}