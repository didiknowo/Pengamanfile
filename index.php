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
        <form class="login-form" action="auth.php" method="post">
            <center>
                <!-- <img src="assets/images/kud_gemolong.png" width="50px" style="margin-bottom: 5px;"> -->
                <h4><b>LOGIN</b></h4>
                <hr>
                
            </center>
            <div class="form-group">
                <label class="control-label">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Masukan nama pengguna"
                autofocus autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="control-label">Kata Sandi</label>
                <input class="form-control" type="password" name="password" placeholder="Masukan kata sandi"
                required><br>
                <p style="font: size 10px;" align="right"><a href="request.php"><u>Lupa Password!</u></a></p>
            </div>
            <div class="form-group text-center">
                <img src="generate.php" alt="gambar" />
            </div>
            <div class="form-group">
                <input class="form-control" name="kode" placeholder="Kode Captcha" maxlength="5" />
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-danger btn-block" name="login" style="margin-bottom: 10px;">MASUK</button>
                <p style="font: size 8px;" align="center">Belum memiliki akun? <a href="signup.php">Daftar Disini</a>
                </p>
                <!-- <p style="font-size:10pt" align="center">&copy; Advanced Encryption Standard (AES-128)</p> -->
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