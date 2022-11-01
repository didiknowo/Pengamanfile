<?php
session_start();
include 'config.php';

$error = '';
if (isset($_POST['login'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password Tidak Valid!";
	} else {

		$user = mysqli_real_escape_string($connect, $_POST['username']);
		$pass = mysqli_real_escape_string($connect, $_POST['password']);

		$query = "SELECT username,password,status,verifikasi FROM users WHERE username = '$user' AND password = md5('$pass')";
		$sql = mysqli_query($connect, $query);
		$cek = mysqli_num_rows($sql);
		if ($cek <= 0) {
			echo '<script language="javascript"> alert("Username atau password salah"); </script>';
			echo '<script> location.replace("index.php"); </script>';
		}
		if ($cek == 1 && $_POST['kode'] == $_SESSION["code"]) {
			while ($row = mysqli_fetch_array($sql)) {
				if ($row['verifikasi'] == 'Tidak') {
					echo '<script language="javascript"> alert("Akun anda belum diaktivasi"); </script>';
					echo '<script> location.replace("index.php"); </script>';
				}
				if ($row['verifikasi'] == 'Blokir') {
					echo '<script language="javascript"> alert("Akun anda telah di non-aktifkan"); </script>';
					echo '<script> location.replace("index.php"); </script>';
				}
				if ($row['verifikasi'] == 'Ya') {
					$_SESSION['username'] = $user;
					$_SESSION['akses'] = $rows['status'];
					if ($row['status'] == 1) {
						header("location: dashboard/index.php");
					} else {
						header("location: dashboard/index.php");
					}
				}
			}
		} else {
			echo '<script language="javascript"> alert("Kode captcha salah...."); </script>';
			echo '<script> location.replace("index.php"); </script>';
		}
	}
}