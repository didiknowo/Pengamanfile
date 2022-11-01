<?php
include "../config.php";

$id = $_GET['id'];
mysqli_query($connect, "UPDATE users SET status = '1', job_title = 'Admin' WHERE username = '$id'");
echo '<script language="javascript"> alert("Akun berhasil dijadikan admin...."); </script>';
echo '<script> location.replace("userdata.php"); </script>';
