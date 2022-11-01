<?php
include 'config.php';

if (isset($_POST["btnReset"])) {
    $newPass = $_POST['password'];
    $newKonfirmasi = $_POST['konfirmasi'];

    if ($newPass == $newKonfirmasi) {
        $new = mysqli_query($connect, "UPDATE users SET password = md5('$newPass') WHERE username = '$username'");
        echo '<script language="javascript"> alert("Proses perubahan password berhasil");</script>';
        echo '<script> location.replace("index.php"); </script>';
    } else {
        echo '<script language="javascript"> alert("Konfirmasi password salah"); </script>';
    }
}
