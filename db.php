<?php
$host = 'localhost';
$username = 'root'; // ganti dengan username MySQL Anda
$password = ''; // ganti dengan password MySQL Anda
$database = 'laundry3'; // ganti dengan nama database Anda

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
