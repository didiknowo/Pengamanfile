<?php
include "../config.php";

$id = $_GET['id'];
mysqli_query($connect, "UPDATE users SET verifikasi = 'Blokir' WHERE username = '$id'");
echo '<script language="javascript"> alert("Akun berhasil dinonaktifkan...."); </script>';
echo '<script> location.replace("userdata.php"); </script>';
