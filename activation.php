<!DOCTYPE html>
<html lang="en">
<?php
include "config.php";
?>

<body>
  <div class="container" align="center">
    <br>
    <?php
    $token = $_GET['t'];
    $sql_cek = mysqli_query($connect, "SELECT * FROM users WHERE token = '$token' AND verifikasi = 'Tidak'");
    $jml_data = mysqli_num_rows($sql_cek);
    if ($jml_data > 0) {
      //update data users aktif
      mysqli_query($connect, "UPDATE users SET verifikasi = 'Ya' WHERE token = '$token' AND verifikasi = 'Tidak'");
      echo '<script language="javascript"> alert("Akun anda sudah aktif"); </script>';
      echo '<script> location.replace("index.php"); </script>';
    } else {
      //data tidak di temukan
      echo '<script language="javascript"> alert("Invalid token...."); </script>';
    }
    ?>
  </div>
</body>

</html>