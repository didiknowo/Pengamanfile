<?php
include "../config.php";

$id = $_GET['id'];
mysqli_query($connect, "UPDATE users SET verifikasi = 'Ya' WHERE username = '$id'");
echo '<script language="javascript"> alert("Akun berhasil diaktifkan...."); </script>';
echo '<script> location.replace("userdata.php"); </script>';
