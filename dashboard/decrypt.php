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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
-->
</head>

<body class="sidebar-mini fixed">
    <!-- NAVBAR SIDEBAR -->
    <?php include('navmenu.php'); ?>
    <div class="content-wrapper">
        <div class="page-title">
            <div>
                <h1><i class="fa fa-file"></i> Dekripsi Berkas</h1>
            </div>

            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index.php">Dashboard</a></li>
                    <li>Dekripsi Berkas</li>
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
                                        <td width="5%"><strong>ID</strong></td>
                                        <td width="20%"><strong>Nama Pengguna</strong></td>
                                        <td width="20%"><strong>Nama Berkas Enkripsi</strong></td>
                                        <td width="20%"><strong>Ukuran Berkas</strong></td>
                                        <td width="15%"><strong>Status Berkas</strong></td>
                                        <td width="10%"><strong>Opsi</strong></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $query = mysqli_query($connect, "SELECT * FROM file");
                                    while ($data = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_file']; ?></td>
                                        <td><?php echo $data['username']; ?></td>
                                        <td><?php echo $data['file_name_finish']; ?></td>
                                        <?php $namabrks = $data['file_name_source']; ?>
                                        <td><?php echo $data['file_size']; ?> KB</td>
                                        <td><?php if ($data['status'] == 1) {
                                                echo "Enkripsi";
                                            } elseif ($data['status'] == 2) {
                                                echo "Dekripsi";
                                            } else {
                                                echo "Status Tidak Diketahui";
                                            }
                                            ?></td>
                                        <td>
                                            <?php
                                                $a = $data['id_file'];
                                                if ($data['status'] == 1) {
                                                  echo '<a href="decrypt-file.php?id_file=' . $a . '" class="btn btn-success" style="width:100%; margin-bottom : 10px;">Dekripsi Berkas</a> <br>';
                                              }
                                              ?>

                                            <a href="delete_file.php?id=<?php echo $data['id_file']; ?>"
                                                class="btn btn-danger" style="width:100%; margin-bottom : 10px;">Hapus
                                                Berkas</a> <br>

                                            <!-- <a href="kirim_file.php?id=<?php echo $data['id_file']; ?>"
                                                    class="btn btn-warning" style="width:100%; margin-bottom : 10px;">Kirim Berkas</a> <br> -->


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
    </div>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
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