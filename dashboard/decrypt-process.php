<?php
session_start();
include "../config.php";   //memasukan koneksi
include "AES.php"; //memasukan file AES

$idfile    = mysqli_escape_string($connect, $_POST['fileid']);
$pwdfile   = mysqli_escape_string($connect, substr(md5($_POST["pwdfile"]), 0, 16));
$query     = "SELECT password FROM file WHERE id_file='$idfile' AND password='$pwdfile'";
$sql       = mysqli_query($connect, $query);
if (mysqli_num_rows($sql) > 0) {
    $query1     = "SELECT * FROM file WHERE id_file='$idfile'";
    $sql1       = mysqli_query($connect, $query1);
    $data       = mysqli_fetch_assoc($sql1);

    $file_path  = $data["file_url"];
    $key        = $data["password"];
    $file_name  = $data["file_name_source"];
    $size       = $data["file_size"];

    $file_size  = filesize($file_path);

    // $query2     = "UPDATE file SET status='2' WHERE id_file='$idfile'";
    // $sql2       = mysqli_query($connect,$query2);

    $mod        = $file_size % 16;

    $aes        = new AES($key);
    $fopen1     = fopen($file_path, "rb");
    $plain      = "";
    $cache      = "file_decrypt/$file_name";
    $fopen2     = fopen($cache, "wb");

    if ($mod == 0) {
        $banyak = $file_size / 16;
    } else {
        $banyak = ($file_size - $mod) / 16;
        $banyak = $banyak + 1;
    }

    ini_set('max_execution_time', -1);
    ini_set('memory_limit', -1);
    for ($bawah = 0; $bawah < $banyak; $bawah++) {

        $filedata    = fread($fopen1, 16);
        $plain       = $aes->decrypt($filedata);
        fwrite($fopen2, $plain);
    }
    $_SESSION["download"] = $cache;

    // echo ("<script language='javascript'>
    //    window.open('download.php', '_blank');
    //    window.location.href='decrypt.php';
    //    window.alert('Berhasil mendekripsi file.');
    //    </script>
    //    ");
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Aplikasi Pengaman Surat</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/css/main_3.css">
        <link rel="stylesheet" href="../assets/css/gaya_2.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
-->
</head>

<body style="background-color:#808080;">

    <!-- <div class="logo">
        <h2>APLIKASI ENKRIPSI SOFTFILE -<b> AES</b></h2>
    </div> -->
    <section class="material-half-bg">
        <div class="cover-gaya" style="background-image: url('../assets/images/gedung.png');  background-repeat: no-repeat;
        background-size: cover;"></div>
    </section>
    <section class="login-content">
        <div class="login-box">
            <form class="login-form" method="post">
              <!--   <center>
                    <img src="../assets/images/kud_gemolong.png" width="50px" style="margin-bottom: 5px;">
                    <h5>KUD Gemolong</h5>
                </center> -->
                <h4 align="center">Membuka Berkas <i
                    style="color:blue"><?php echo $file_name; ?></i></h4>
                <!-- <div class="form-group text-center">
                    <label class="control-label"><?php echo $file_name; ?></label>
                </div -->
                <div class="form-group btn-container align-item-center">
                    <a href="<?php echo $cache; ?>" class="btn btn-success btn-block mb-3">Buka File</a>
                    <a href="file_close.php?link=<?php echo $cache; ?>" class="btn btn-danger btn-block" name="btnClose"
                        style="margin-bottom: 10px;">Tutup Dokumen</a>
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

    <?php
}