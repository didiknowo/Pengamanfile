<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
    header("location:../index.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity = NOW() WHERE username='$last'";
$queryupdate = mysqli_query($connect, $sqlupdate);
?>
<!DOCTYPE html>
<html>
<?php
$user = $_SESSION['username'];
$query = mysqli_query($connect, "SELECT fullname,job_title,last_activity FROM users WHERE username='$user'");
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
                <h1><i class="fa fa-user"></i> Daftar User</h1>
            </div>
            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index.php">Dashboard</a></li>
                    <li>Daftar Berkas</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="file" class="table striped">
                                <thead class="bg-primary">
                                    <tr>
                                        <td><strong>Username</strong></td>
                                        <td><strong>Nama Pengguna</strong></td>
                                        <td><strong>Bergabung</strong></td>
                                        <td><strong>Aktivitas Terakhir</strong></td>
                                        <td><strong>Status</strong></td>
                                        <td width="15%"><strong>Aksi</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = mysqli_query($connect, "SELECT username,fullname,verifikasi,
                                    DATE_FORMAT(join_date, '%d') as joinDate, DATE_FORMAT(join_date, '%M') as joinMonth,DATE_FORMAT(join_date, '%Y') as joinYear,DATE_FORMAT(join_date, '%H:%i:%s') as joinTime,
                                    DATE_FORMAT(last_activity, '%d') as lastDate, DATE_FORMAT(last_activity, '%M') as lastMonth,DATE_FORMAT(last_activity, '%Y') as lastYear,DATE_FORMAT(last_activity, '%H:%i:%s') as lastTime,
                                    status FROM users WHERE status != 1 AND verifikasi = 'Ya' OR verifikasi = 'Blokir' ORDER BY last_activity DESC");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $joinMonth = $data['joinMonth'];
                                        $lastMonth = $data['lastMonth'];
                                        if ($joinMonth == 'Pebruari') {
                                            $joinMonth = 'Februari';
                                        } else {
                                            $joinMonth = $data['joinMonth'];
                                        }
                                        if ($lastMonth == 'Pebruari') {
                                            $lastMonth = 'Februari';
                                        } else {
                                            $lastMonth = $data['lastMonth'];
                                        }
                                        if ($data['verifikasi'] == "Ya") {
                                            $status = "Aktif";
                                        }
                                        if ($data['verifikasi'] == "Blokir") {
                                            $status = "Tidak Aktif";
                                        }

                                    ?>
                                        <tr>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['fullname']; ?></td>
                                            <td><?php echo $data['joinDate'] . " " . $joinMonth . " " . $data['joinYear'] . " " . $data['joinTime']; ?> WIB</td>
                                            <td><?php echo $data['lastDate'] . " " . $lastMonth . " " . $data['lastYear'] . " " . $data['lastTime']; ?> WIB</td>
                                            <td><?php echo $status; ?></td>
                                            <td>
                                                <a href="profile.php?id=<?php echo $data['username']; ?>" class="btn btn-warning" style="width:100%;">Lihat Profile</a>
                                                <?php
                                                if ($data['verifikasi'] == "Ya") {
                                                ?>
                                                    <a href="profile_nonaktif.php?id=<?php echo $data['username']; ?>" class="btn btn-danger" style="width:100%; margin-top:10px;">Nonaktifkan</a>
                                                    <a href="profile_admin.php?id=<?php echo $data['username']; ?>" class="btn btn-info" style="width:100%; margin-top:10px;">Jadikan Admin</a>
                                                <?php
                                                }
                                                if ($data['verifikasi'] == "Blokir") {
                                                ?>
                                                    <a href="profile_aktif.php?id=<?php echo $data['username']; ?>" class="btn btn-success" style="width:100%; margin-top:10px;">Aktifkan</a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
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