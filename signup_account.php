<?php
include 'config.php';

if (isset($_POST["btn_daftar"])) {
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm = $_POST['konfirmasi'];
  $token = hash('sha256', md5(date('Y-m-d-H-i-s')));

  if ($password == $confirm) {
    $regist = mysqli_query($connect, "INSERT INTO users VALUES('$username',md5('$password'),'$email','$username','user',NULL,'Tidak',NOW(),NOW(),'2','$token')");

    if ($regist) {
      include("mail.php");
      echo '<script language="javascript"> alert("Proses pendaftaran berhasil silakan cek aktivasi email"); </script>';
      echo '<script> location.replace("index.php"); </script>';
    } else {
      echo '<script language="javascript"> alert("Proses pendaftaran gagal, username sudah digunakan atau konfirmasi password salah"); </script>';
      echo '<script> location.replace("index.php"); </script>';
    }
  } else {
    echo '<script language="javascript"> alert("Proses pendaftaran gagal, username sudah digunakan atau konfirmasi password salah"); </script>';
    echo '<script> location.replace("index.php"); </script>';
  }
}
