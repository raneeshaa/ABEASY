<?php 

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'Absensi';

$mysqli = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Periksa apakah koneksi berhasil
if (!$mysqli) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
?>