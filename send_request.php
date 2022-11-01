<?php
include 'config.php';

if (isset($_POST["btnRequest"])) {

    $username = $_POST['username'];
    $token = hash('sha256', md5(date('Y-m-d-H-i-s')));
    $user = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");
    $data = mysqli_fetch_array($user);
    $email = $data['email'];
    $cek = mysqli_num_rows($user);

    if ($cek != 0) {
        $request = mysqli_query($connect, "UPDATE users SET token = '$token' WHERE username = '$username'");
        include("forget_password_mail.php");
        echo '<script language="javascript"> alert("Silakan cek email untuk melanjutkan aksi"); </script>';
        echo '<script> location.replace("request.php"); </script>';
    } else {
        echo '<script language="javascript"> alert("Username tidak ditemukan..."); </script>';
        echo '<script> location.replace("request.php"); </script>';
    }
}
