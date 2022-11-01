<?php
$host = 'localhost'; //Host yang digunakan Localhost atau 127.0.0.1
$user = 'root'; //Username dari Host yakni root
$pass = ''; //User root tidak menggunakan password
$dbname = 'aes_6'; //Nama Database Aplikasi Enkirpsi dan Dekripsi
$connect = mysqli_connect($host, $user, $pass, $dbname);
if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_query($connect, "SET time_zone = '+07:00'");
mysqli_query($connect, "SET lc_time_names = 'id_ID'");