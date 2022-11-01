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
        <form class="login-form" action="send_request.php" method="post">
            <center>
               <!--  <img src="assets/images/kud_gemolong.png" width="50px" style="margin-bottom: 5px;">
                <h5>KUD Gemolong</h5> -->
                <br>
                <strong>Permintaan Password Baru</strong>
            </center><br>
            <div class="form-group">
                <label class="control-label">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Masukan nama pengguna" autofocus autocomplete="off" required>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-danger btn-block" name="btnRequest" style="margin-bottom: 10px;">KIRIM PERMINTAAN</button>
            </div>
        </form>
    </div>
</section>
</body>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/essential-plugins.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/pace.min.js"></script>
<script src="assets/js/main.js"></script>

</html>