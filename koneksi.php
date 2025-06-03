<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ukt_kampus";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
