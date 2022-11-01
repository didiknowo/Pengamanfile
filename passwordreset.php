<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi Pengaman Surat</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main_3.css">
    <link rel="stylesheet" href="assets/css/gaya_2.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
-->
</head>

<br>
<?php
$token = $_GET['t'];
$username = $_GET['username'];
$sql_cek = mysqli_query($connect, "SELECT * FROM users WHERE token = '$token' AND username = '$username'");
$jml_data = mysqli_num_rows($sql_cek);
if ($jml_data > 0) {
    ?>

    <body style="background-color:#808080;">
        <section class="material-half-bg">
            <div class="cover-gaya" style="background-image: url('assets/images/gedung.png');  background-repeat: no-repeat;
            background-size: cover;"></div>
        </section>
        <section class="login-content">
            <!-- <div class="logo">
        <h2>APLIKASI ENKRIPSI SOFTFILE -<b> AES</b></h2>
    </div> -->
    <div class="login-box">
        <form class="login-form" method="post">
                    <!-- <center>
                        <img src="assets/images/kud_gemolong.png" width="50px" style="margin-bottom: 5px;">
                        <h5>KUD Gemolong</h5>
                        <br>
                        <strong>Password Baru</strong>
                    </center> -->
                    <div class="form-group">
                        <label class="control-label">Password Baru</label>
                        <input class="form-control" type="password" name="password" placeholder="Masukan password baru" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Konfirmasi</label>
                        <input class="form-control" type="password" name="konfirmasi" placeholder="Ulangi password baru" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-danger btn-block" name="btnReset" style="margin-bottom: 10px;">KIRIM PERMINTAAN</button>
                    </div>
                </form>
            </div>
        </section>
        <?php
    } else {
    //data tidak di temukan
        echo '<script language="javascript"> alert("Invalid token...."); </script>';
        echo '<script> location.replace("index.php"); </script>';
    }
    ?>
</body>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/essential-plugins.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/pace.min.js"></script>
<script src="assets/js/main.js"></script>

</html>

<?php
include "new_password.php";
?>