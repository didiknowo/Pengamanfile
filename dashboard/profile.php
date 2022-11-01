<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
    header("location:../index.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity=now() WHERE username='$last'";
$queryupdate = mysqli_query($connect, $sqlupdate);
?>
<!DOCTYPE html>
<html>
<?php
$username = $_SESSION['username'];
$query = mysqli_query($connect, "SELECT fullname,job_title,last_activity FROM users WHERE username='$username'");
$data = mysqli_fetch_array($query);
?>

<head>
    <title> <?php echo $data['fullname']; ?> - AES-128</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/main_3.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/datatables/css/jquery.dataTables.css">

</head>

<body class="sidebar-mini fixed">
    <!-- NAVBAR SIDEBAR -->
    <?php include('navmenu.php'); ?>
    <div class="content-wrapper">
        <div class="page-title">
            <div>
                <h1><i class="fa fa-user"></i> Profil</h1>
            </div>
            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index.php">Dashboard</a></li>
                    <li>Profil</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <?php
                $userdata = $_GET['id'];
                $query = mysqli_query($connect, "SELECT username,fullname,email,img
                    FROM users WHERE username = '$userdata'");
                $data = mysqli_fetch_array($query);
                $images = $data['img'];
                if ($images == NULL) {
                    $images = "default.png";
                }
                ?>
                <div class="card mb-4 w-100">
                    <div class="card-body align-self-center">
                        <form method="POST" enctype="multipart/form-data">
                            <table class="table table-borderless">
                                <?php
                                if ($username == $userdata) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <div>
                                                    <img src="../assets/images/user/<?php echo $images; ?>"
                                                    class="img-circle" height="150px">
                                                </div>
                                                <div style="margin-top: 10pt; width:50%;">
                                                    <input type="file" name="photo" class="form-control">
                                                </div>
                                                <div style="margin-top: 10pt;">
                                                    <button name="btnFoto" class="btn btn-primary w-100">Ubah Foto</button>
                                                </div>
                                            </td>
                                            <td class="align-self-center">
                                                <div style="font-weight: bold;">Username</div>
                                                <div class="input-group flex-nowrap mb-3" style="width:100%;">
                                                    <input disabled type="text" name="username" class="form-control"
                                                    value="<?php echo $data['username']; ?>"
                                                    aria-describedby="addon-wrapping">
                                                </div>
                                                <div style="font-weight: bold;">Email</div>
                                                <div class="input-group flex-nowrap mb-3" style="width:100%;">
                                                    <input type="text" name="email" class="form-control"
                                                    value="<?php echo $data['email']; ?>"
                                                    aria-describedby="addon-wrapping">
                                                </div>
                                                <div style="font-weight: bold;">Nama Lengkap</div>
                                                <div class="input-group flex-nowrap mb-3" style="width:100%;">
                                                    <input type="text" name="nama" class="form-control"
                                                    value="<?php echo $data['fullname']; ?>"
                                                    aria-describedby="addon-wrapping">
                                                </div>

                                                <input type="submit" name="btnSimpan" class="btn btn-primary w-100"
                                                value="Simpan Perubahan" style="width:100%; margin-top:20px;">
                                            </td>
                                            <?php
                                            include '../config.php';

                                            if (isset($_POST["btnSimpan"])) {

                                                $email = $_POST['email'];
                                                $nama = $_POST['nama'];
                                                $edit = mysqli_query($connect, "UPDATE users SET email = '$email', fullname = '$nama' WHERE username = '$username'");
                                                if ($edit) {
                                                    echo '<script language="javascript"> alert("Data berhasil diubah"); </script>';
                                                    echo '<script> location.replace("profile.php?id=' . $username . '"); </script>';
                                                } else {
                                                    echo '<script language="javascript"> alert("Terjadi kesalahan dalam mengubah data"); </script>';
                                                    echo '<script> location.replace("profile.php?id=' . $username . '"); </script>';
                                                }
                                            }
                                            ?>
                                            <?php
                                        } else {
                                            ?>
                                            <tbody>
                                                <!-- Lihat profile User -->
                                                <tr>
                                                    <td align="center">
                                                        <div>
                                                            <img src="../assets/images/user/<?php echo $images; ?>"
                                                            class="img-circle" height="200px">
                                                        </div>
                                                        <div style="font-weight: bold; margin-top:10px;">Username</div>
                                                        <div class="input-group flex-nowrap" style="width:50%;">
                                                            <?php echo $data['username']; ?>
                                                        </div>
                                                        <div style="font-weight: bold; margin-top:10px;">Email</div>
                                                        <div class="input-group flex-nowrap" style="width:50%;">
                                                            <?php echo $data['email']; ?>
                                                        </div>
                                                        <div style="font-weight: bold; margin-top:10px;">Nama Lengkap</div>
                                                        <div class="input-group flex-nowrap" style="width:50%;">
                                                            <?php echo $data['fullname']; ?>
                                                        </div>
                                                    </td>

                                                    <?php
                                                }
                                                ?>

                                            </tr>
                                            <tr>

                                            </tr>
                                        </tbody> <!-- End lihat Lihat profile User -->
                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script src="../assets/js/jquery-2.1.4.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#file').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": true,
                        "bAutoWidth": true,
                        "order": [0, "asc"]
                    });
                });
            </script>
            <script src="../assets/js/essential-plugins.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
            <script src="../assets/plugins/datatables/js/jquery.dataTables.js"></script>
            <script src="../assets/js/plugins/pace.min.js"></script>
            <script src="../assets/js/main.js"></script>
        </body>

        </html>
        <?php
        if (isset($_POST["btnFoto"])) {

            $search = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");
            $data = mysqli_fetch_array($search);

            if ($data['img'] != NULL) {
                $files    = glob('../assets/images/user/' . $data['img']);
                foreach ($files as $file) {
                    if (is_file($file))
                        unlink($file);
                }
            }

            var_dump($file);

            $dir = "../assets/images/user/";
            $edit_foto = $username . date('Ymdhis') . '.jpg';
            move_uploaded_file($_FILES["photo"]["tmp_name"], $dir . $edit_foto);

            $edit_img = mysqli_query(
                $connect,
                "UPDATE users SET img = '$edit_foto' WHERE username = '$username'"
            );
            echo '<script> location.replace("profile.php?id=' . $username . '"); </script>';
        }
        ?>